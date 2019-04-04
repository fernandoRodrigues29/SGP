    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
       
        var data_1 = google.visualization.arrayToDataTable([
          <?php 
          $c1 = count($lista);
          $x1 = 1;
          echo "['', ''],";
          foreach ($lista as $value) {
              echo "['".$value['produto']."',".$value['qtd']."]";
              if($x1<$c1){ echo ","; }
              $x1++;
          }
          ?>
        ]);
       var options_1 = {
          title: 'Estoque'
        };
        var chart1 = new google.visualization.PieChart(document.getElementById('chart-area'));
/*----*/
        var data_2 = google.visualization.arrayToDataTable([
          <?php 
          $c1 = count($lista2);
          $x1 = 1;
          echo "['', ''],";
          foreach ($lista2 as $value2) {
              echo "['".$value2['marca']."',".$value2['qtd']."]";
              if($x1<$c1){ echo ","; }
              $x1++;
          }
          ?>
        ]);
       var options_2 = {
          title: 'Marcadores'
        };
        var chart2 = new google.visualization.PieChart(document.getElementById('chart-area2'));        
/*-----*/
       var data_3 = google.visualization.arrayToDataTable([
          <?php 
          $c1 = count($lista3);
          $x1 = 1;
          echo "['', ''],";
          foreach ($lista3 as $value3) {
              echo "['".$value3['tipo']."',".$value3['qtd']."]";
              if($x1<$c1){ echo ","; }
              $x1++;
          }
          ?>
        ]);
       var options_3 = {
          title: 'Tipo'
        };
        var chart3 = new google.visualization.PieChart(document.getElementById('chart-tipo')); 
/*-----*/
chart1.draw(data_1, options_1);
chart2.draw(data_2, options_2);
chart3.draw(data_3, options_3);
      }
    </script>
<div class="row">
   <div class="col-md-6">
    <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Estoque</h3>
                              <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <div class="box-body">
                              <div id="chart-area" ></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
   </div>
   <div class="col-md-6">
    <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Marcadores</h3>
                              <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <div class="box-body">
                              <div id="chart-area2" ></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
   </div> 
</div>

<div class="row">
   <div class="col-md-6">
    <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Tipos</h3>
                              <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <div class="box-body">
                              <div id="chart-tipo" ></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
   </div>
</div>    


