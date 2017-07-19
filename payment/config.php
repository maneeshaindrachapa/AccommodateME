<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_W0hp2nH5sm8thGJ5JJIVDLfZ",
  "publishable_key" => "pk_test_IInRZxJUI7kkIvjYooSvK8LZ"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>