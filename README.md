# PaymentPaypal

<b>Pagando con Paypal</b>

<p>La clase en donde se deben colocar los datos que proporciona PayPal es decir, <b>ClienteID</b> y <b>Secret</b> se agrega en el archivo PaypalPayment.php.</p>

<p>Se encuentran seís variables que deben ser modificada inicialmente, dependiendo del modo a utilizar</p>

<ul>
<li><b>$this->mode</b> en la línea 17, si es <b>sandbox</b> ó <b>production</b></li>
</ul>
<p>Para el modo de sandbox, debes agregar dentro de las comillas simples los valores que corresponde:</p>
<ul>
<li><b>$this->clienteIDSandbox</b> en la línea 19</li>
<li><b>$this->secretSandbox</b> en la línea 20</li>
</ul>

<p>Para el modo de production, debes agregar dentro de las comillas simples los valores que corresponde:</p>
<ul>
<li><b>$this->clienteIDLive</b> en la línea 22</li>
<li><b>$this->secretLive</b> en la línea 23</li>
</ul>

<p>El tipo de moneda para la transación:</p>
<ul>
 <li><b>$this->currency</b>, línea 25</li>
</ul>
<p>El método <b>verify</b> deben culminarlo o adaptarlo según su lógica de negocio, 
yo recogo los valores que requiero y que pienso que son suficiente, pero si usted le hace un <b>var_dump($object)</b> en la línea 92 podrá observar toda la
información que devuelve el objeto.</p>
<p>Yo por ejemplo en el poyecto en donde lo voy a implementar pienso hacer lo siguiente dentro de ese método:</p>
<ol>
  <li>Desencriptar el custom en donde pienso mantener el ID de la orden, para poderle cambiar el status a Por embalar, en sí identificarlo en la base de datos</li>
  <li>Consultar el monto, aunque también lo puedo enviar dentro del custom, lo dijo de esta manera porque aún estoy pensando en como lo voy hacer.</li>
  <li>Corroborar que <b>$currency</b> sea igual a <b>$this->currency</b></li>
  <li>Corroborar que el <b>$total</b> sea igual al total de la orden</li>
  <li>si todo va bien, registro los datos en una entidad, la cual puedo llamar xxxxxxPaypal</li>
  <li>Por último llamo un método del controlador de la Orden y le indico que actualice el status a Por embalar</li>
</ol>

<p><b>Otros cambios que se debe realizar</b>: El archivo <b>verificar.php</b> debes concluirlo a tu manera, yo lo hice así de simple porque yo trabajo con el modelo MVC. e incluso a la clase debo
agregarle el namespace, pero aquí deberás redireccionar a una página en donde muestre el mensaje final, de igual forma el <b>index.php</b> deberá ajustarlo a la lógica y diseño de tu proyecto</p>
