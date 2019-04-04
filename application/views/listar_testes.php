
<h4 class="text-center">Consulta</h4>
<div class="col-lg-12">
<?php
if(!empty($_SESSION['msg_del'])){
     $ar_m = $_SESSION['msg_del'];
     $typ = $ar_m[0];
     $mensagem = $ar_m[1];
?>
    <div class="row">
        <div class="alert <?php echo $typ;?> alert-dismissable"><?php echo $mensagem;?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> </div>
    </div>
<?php 
unset($_SESSION['msg_del']);}
?>

    <div class="table-responsive">
     <div class="col-md-10">   
       <div class="row">
        <div class="col-lg-offset-6 col-lg-6">
           <input type="text"  id="pesquisa_input" name="pesquisa" placeholder= "Lista testes" style="height: 34px;">
            <button type="submit" alt="Pesquisar" id="botao" class="btn btn-success">
                <i class="fa fa-search"></i>
            </button>
        </div>
       </div>
       <table class="table table-striped table-bordered table-hover" id="dataTables-ajax" style="min-height: 10; max-height: 10;">
          <thead>
            <tr>
              <th>#0</th>  
              <th>#1</th>
              <th>#2</th>
               <th>#2</th>
	    </tr>
         </thead>
             <tbody>  </tbody>
               

         </table>
     </div>
      <div class="row">
          <div class="col-md-10">
              <ul class="pagination">
                <!--
                <li><a href="#">1</a></li>
                <li class="disabled"><a href="#">4</a></li>
                <li><a href="#">5</a></li>-->
              </ul>
          </div>
      </div>
    </div>
    <div id="teste"></div>
    <table id="tabel" border="1"></table>
    
</div>
<script>
/**/    
$(document).ready(function(){
   //iniciando variaveis globais 
   limite = ''; total='';pesquisa='';
  //esse e o pomo de ouro
    $.getJSON("<?php echo base_url('index.php/maincontroller/desenvolvimento_json');?>", function(result){
        limite = 5;
        total = result.qtd ;
        var t = total/limite;
        var total_pag = Math.ceil(t);
        var conteiner =$('#dataTables-ajax tbody');
        var linha='';
        /**/
        console.log(result);
        for (var key in result.lista) {
             var conteudo = result.lista[key];
                $('#dataTables-ajax tbody').append($('<tr>')
                    .append($('<td>').append(conteudo.id))
                    .append($('<td>').append(conteudo.codigo_uf))
                    .append($('<td>').append(conteudo.uf))
                    .append($('<td>').append(conteudo.estado)
                    ));
                /**
                for (var ind in conteudo) {
                    console.log(ind+"-"+conteudo[ind]);   
                }
               /**/ 
        }
         for(var x=1;x<=total_pag;x++){
            //console.log(x); 
            $('.pagination').append($('<li>').append('<a href="#">'+x+'</a>'));
         }
         /**/
     });
     $('.pagination').delegate('li', 'click', function() {
        var pagn = $(this).text();
        if(pesquisa != ""){
            console.log('a pesquisa foi '+pesquisa);
            var q=pesquisa;
        }else{
            var q='';
        }
        
        $.post("<?php echo base_url('index.php/maincontroller/desenvolvimento_json');?>",
        {lmt:limite,offst:pagn,psq: q},
        function(data){
        console.log(data);
          //alert(data);
        objData = $.parseJSON(data);
        console.log(objData.lista);
        $('#dataTables-ajax tbody').html('');
         for (var key in objData.lista) {
             var campos = objData.lista[key];
                 $('#dataTables-ajax').append($('<tr>')
                    .append($('<td>').append(campos.id))
                    .append($('<td>').append(campos.codigo_uf))
                    .append($('<td>').append(campos.uf))
                    .append($('<td>').append(campos.estado)
                  ));
        }
       });
     });
     
     $('#botao').click(function(){
       if(pesquisa != ""){
        console.log('pesquisa anterior '+pesquisa);
       }
        console.log(total);
        var q = $('#pesquisa_input').val();
       if(q !=''){ 
            pesquisa = q;
            console.log(q);
            $.post("<?php echo base_url('index.php/maincontroller/controle2');?>",
                { lmt: 5,offst: 1,psq: q},
                function(data, status){
                    console.log(data);
                    //objjason = $.parseJSON(data);
                    //console.log(objjason);
                    objData = $.parseJSON(data);
                    console.log(objData.lista);
                    console.log(objData.qtd);
                    total = objData.qtd;
                    console.log("total alterado "+total);
                    $('#dataTables-ajax tbody').html('');
                     for (var key in objData.lista) {
                         var campos = objData.lista[key];
                             $('#dataTables-ajax').append($('<tr>')
                                .append($('<td>').append(campos.id))
                                .append($('<td>').append(campos.codigo_uf))
                                .append($('<td>').append(campos.uf))
                                .append($('<td>').append(campos.estado)
                              ));
                    }
                    //construir paginacaos
                            console.log("total pos alterado "+total);
                            var t = total/limite;
                            console.log('resultado 1 conta '+t);
                            var total_pag = Math.ceil(t);
                             console.log('resultado 2 conta '+total_pag);
                            $('.pagination').html('');
                            for(x=1;x<=total_pag;x++){
                              $('.pagination').append($('<li>').append('<a href="#">'+x+'</a>'));
                            }
                    
                }).fail(function(textStatus, errorThrown) {
                    console.log("error " + textStatus, errorThrown);
                });
                //---
        }else{
        alert('preencha o campo de busca!');
        }    
      });
});
</script>
<!---->
