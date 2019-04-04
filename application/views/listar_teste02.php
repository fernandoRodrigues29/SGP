<h4 class="text-center">Consulta</h4>
<div class="col-lg-12">
    <div class="table-responsive">
     <div class="col-md-10">   
       <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3"><input type="text" name="valor" placeholder= "Lista testes">
            <button type="submit" alt="Pesquisar" id="botao" class="btn btn-success">
              <i class="fa fa-search"></i> 
            </button>
        </div>
      </div>
       <table class="table table-striped table-bordered table-hover" id="dt-ajax">
          <thead>
            <tr>
              <th>#</th>
              <th>#2</th>
	      <th>#3</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
         </table>
            <ul class="list-inline" id="links">
                <li value="2">2</li>
              <li value="3">3</li>
              <li value="4">4</li>
            </ul>
         <input type="button" value="Teste" id="get-data">
     </div>
       <div id="tabela">
        <ul class="listagem"></ul>
       </div>   
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#links li').click(function(){
            $.post( "<?php echo base_url("index.php/testes_c/teste_json"); ?>",{offset:$(this).val()} ,function(data) {
                console.log(data);
                    //console.log(data);
                    $("#dt-ajax > tbody").html("");
                     $.each( JSON.parse(data), function( key, value ) {
                        $( "#dt-ajax" ).append( "<tr><td>"+value.codigo_uf+"</td><td>"+value.estado+"</td><td>"+value.uf+"</td></tr>" );
                      });
                  
            });           
        });
    
        $.getJSON('<?php echo base_url("index.php/testes_c/teste_json"); ?>', function (data) {
          //console.log(data);
           $.each( data, function( key, value ) {
                $( "#dt-ajax" ).append( "<tr><td>"+value.codigo_uf+"</td><td>"+value.estado+"</td><td>"+value.uf+"</td></tr>" );
            });
        });
    });
    </script>
<!---->
