<?php 

$container->setParameter('database_host', getenv("SYMFONY__database_host"));
$container->setParameter('database_port', getenv("SYMFONY__database_port"));
$container->setParameter('database_name', getenv("SYMFONY__datrabase_name"));
$container->setParameter('database_user', getenv("SYMFONY__database_user"));
$container->setParameter('database_password', getenv("SYMFONY__database_password"));

//Smtp Settings
$container->setParameter('mailer_transport', 'smtp');
$container->setParameter('mailer_host', getenv('SYMFONY__smtp_host'));

$useSmtpSSL=boolval(getenv('SYMFONY__smtp_use_ssl'));
if($useSmtpSSL){	
 $container->setParameter('mailer_encryption_method', 'ssl');
}

$container->setParameter('mailer_port', getenv('SYMFONY__smtp_port'));
$container->setParameter('mailer_user', getenv('SYMFONY__smtp_user'));
$container->setParameter('mailer_password', getenv('SYMFONY__smtp_password'));

$container->setParameter('app_name', getenv('SYMFONY__app_name'));

$container->setParameter('secret','am122pempa321mplotou$kei8emplom');