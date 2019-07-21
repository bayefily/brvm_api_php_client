<?php
function get_data(){
  $location = "http://bfin.brvm.org/wsbrvm/wsbrvm.asmx?wsdl";
  $uri = "http://tempuri.org/";
  // Define SOAP Client options.
  $options = [
    'location'     => $location,
    'uri'          => $uri,
    'trace'        => true,
    'cache_wsdl'   => WSDL_CACHE_NONE,
    'soap_version' => SOAP_1_2,
    'ssl_method'   => SOAP_SSL_METHOD_SSLv23,
  ];
  // Init variables client.
  $client = new SoapClient(null, $options);
  // Consume "webServiceMethodName" method.
  try {
    $gca = $client->GET_COURS_ACTIONS();
    $data_gca = $gca->ClassCoursActions;
    $gco = $client->GET_COURS_OBLIGATIONS();
    $data_gco = $gco->ClassCoursObligations;
    $gir = $client->GET_INDICES_REFERENCE();
    $data_gir = $gir->ClassIndicesReference;
    foreach ($data_gca as $item) {
    echo'<div class="owl-item" style="width: 136px;">';
        echo'<div class="item">';
          echo'<span>'.$item->Code_symbole.'</span> ';
          echo'<span>'.number_format((float)$item->Cours_Cloture, 2, '.', '').'</span> ';
          echo'<span>'.number_format((float)$item->Variation_Pourcentage, 2, '.', '') .'%'.'</span> ';
          if ($item->Variation_Pourcentage <= 0) {
            echo'<span class="icone-seance bad"></span>';
          } else {
            echo'<span class="icone-seance good"></span>';
          }
        echo'</div>';
      echo'</div>';
    }


  } catch (SoapFault $exception) {
    // Catch an exception.
    var_dump($exception);
  }
}
get_data();


