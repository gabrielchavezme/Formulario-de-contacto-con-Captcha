<?php {
session_start();
if ( isset($_POST['guvenlikKodu']) && $_POST['guvenlikKodu'] ){
 $guvenlikKontrol = false;
 if ( $_POST['guvenlikKodu'] == $_SESSION['guvenlikKodu'] ){
 $guvenlikKontrol = true;
 }
 if ( $guvenlikKontrol ){
$text=$_POST['text'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$domain=$_SERVER['HTTP_HOST'];
$ipadress=$_SERVER['REMOTE_ADDR'];
$date = date("d.m.Y");
$time = date("H:i:s");
require("class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host     = "your-smtp-server.com"; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = "contacto@your-smtp-server.com";  // SMTP username
$mail->Password = "YOUR-PASSWORD-EMAIL"; // SMTP password
$mail->From     = "FORM NAME"; // it must be a match with SMTP username
$mail->Fromname = "FROM NAME"; // from name
$mail->AddAddress("CORREO AL QUE LLEGARA","NOMBRE"); // SMTP username , Name Surname
$mail->Subject  =  "Contacto desde su sitio web";
$content = "<h2>Tienes un mensaje desde $domain</h2>  <p><b>Nombre: </b> $name</p> <p><b>Correo: </b> $email</p> <p><b>Telefono: </b> $phone</p> <br> <p><b>Mensaje: </b> $text</p> <p><h5>Fecha: $date . $time </h5></p> <p><h5>Direccion IP del cliente: $ipadress</h5> </p><p><h5>Este mensaje fue enviado desde tu formulario de contacto</h5></p>";
$mail->MsgHTML($content);
if(!$mail->Send())
{
   echo "<center>Error! hay algo mal :</center>";
   echo "Mailer Error: " . $mail->ErrorInfo;
    echo "<center><p><input type='submit' onclick='gostergizle();' value='Regresar' /></p></center>";
   exit;
}
echo "<script>alert('¡Mensaje enviado satisfactoriamente!'); document.location.href='http://cirujanooncologo.net/'</script>";
 } else {
 echo "<center><div class='alerta-mal' role='alert'>
  <strong>Hubo un error!</strong> ingresa toda la información correctamente e intenta de nuevo...
</div></center>";
 }
}
}
?>
