<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use App\Models\Cliente;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use AmrShawky\LaravelCurrency\Facade\Currency;
use PayPal\Exception\PayPalConnectionException;

class PayPalController extends Controller
{

    private $apiContext;

    public function __construct()
    {
       $payPalConfig = Config::get('paypal');

       $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
       );
    }


    public function payWithPayPal(Cuota $cuota)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $moneda_cliente = Cliente::select('moneda')->where('id', $cuota->cliente_id)->first()->moneda;
        
        $conversion = Currency::convert()->from('EUR')->to($moneda_cliente)->amount($cuota->importe)->get();
        $total = round($conversion, 2);

        $amount = new Amount();
        $amount->setTotal($total);
        $amount->setCurrency($moneda_cliente);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Pago de cuota mensual');

        $callbackUrl = url('/paypal/status/'.$cuota->id);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        
        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
            // En producción poner una redirección para informar de pago fallido
        }
    }

    public function payPalStatus(Request $request, Cuota $cuota)
    {
        $paymentId = $request->input('paymentId');
        $token = $request->input('token');
        $payerId = $request->input('PayerID');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'El pago a través de PayPal ha sido cancelado.';
            return redirect(route('paypal-failed'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /* Execute the payment */
        $result = $payment->execute($execution, $this->apiContext);
        
        if ($result->getState() === 'approved') {
            $status = '¡Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            $cuota = Cuota::find($cuota->id)->update(['pagado' => 1, 'fecha_pago' => date('Y-m-d\TH:i')]);
            return redirect(route('cuotas.index'))->with(compact('status'));
        }

        $status = '¡Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect(route('cuotas.index'))->with(compact('status'));
    }

    public function pagoRechazado()
    {
        return to_route('cuotas.index')->with('status', 'El pago a través de PayPal ha sido cancelado.');
    }
}
