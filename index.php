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
    $data_gir = $gir->ClassCoursObligations;


  $data_slice_gca = array_slice($data_gca, 0, 5);
  $data_slice_gco = array_slice($data_gco, 0, 5);
  $data_slice_gir = array_slice($data_gir, 0, 5);

  echo'<div class="col-md-4">';
  echo '<table class="table">';
  echo '<thead class="thead-dark"><tr><th>top 5</td><th>Cloture</th><th>Variation</th></tr></thead>';
  foreach ($data_slice_gca as $item) {
      echo '<tr>';
      echo '<td>'.$item->Code_symbole.'</td>';
      echo '<td>'.number_format((float)$item->Cours_Cloture, 2, '.', '').'</td>';
      echo '<td>'.number_format((float)$item->Variation_Pourcentage, 2, '.', '') ."%".'</td>';
      echo '</tr>';
  }
  echo '</table>';
  echo'</div>';
  echo'<div class="col-md-4">';
  echo '<table class="table">';
  echo '<thead class="thead-dark"><tr><th>top 5</td><th>Cloture</th><th>Variation</th></tr></thead>';
  foreach ($data_slice_gca as $item) {
      echo '<tr>';
      echo '<td>'.$item->Code_symbole.'</td>';
      echo '<td>'.number_format((float)$item->Cours_Cloture, 2, '.', '').'</td>';
      echo '<td>'.number_format((float)$item->Variation_Pourcentage, 2, '.', '') ."%".'</td>';
      echo '</tr>';
  }
  echo '</table>';
  echo'</div>';
  echo'<div class="col-md-4">';
  echo '<table class="table">';
  echo '<thead class="thead-dark"><tr><th>top 5</td><th>Cloture</th><th>Variation</th></tr></thead>';
  foreach ($data_slice_gca as $item) {
      echo '<tr>';
      echo '<td>'.$item->Code_symbole.'</td>';
      echo '<td>'.number_format((float)$item->Cours_Cloture, 2, '.', '').'</td>';
      echo '<td>'.number_format((float)$item->Variation_Pourcentage, 2, '.', '') ."%".'</td>';
      echo '</tr>';
  }
  echo '</table>';
  echo'</div>';


  } catch (SoapFault $exception) {
    // Catch an exception.
    var_dump($exception);
  }
}
get_data();


