<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $tittle; ?><br>
        <small><?= $subtittle; ?></small>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        
        <div class="panel panel-primary panel-awal">
            <div class="panel-heading">
                <h3 class="panel-title">Data</h3>
            </div>
            <div class="panel-body">
                <?= form_open($form.'/proses');?>
                <?= isset($table_data)?$table_data:''; ?>
                <input type="button" class="btn btn-success pull-right btnproses" name="process" value="Proses">
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="panel panel-primary panel-train" style="display:none;">
            <div class="panel-heading">
                <h3 class="panel-title">Hasil</h3>
            </div>
            <div class="panel-body">
                <div class="panel-body-hasil"></div>
                <input type="button" class="btn btn-success pull-right btnproses" name="process" value="Proses">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btnproses').click( function() {
            //var data = table.$('input').serialize();
            var url = '<?= base_url("k2/hitung/proses");?>';
            $.ajax({
                type: "POST",
                url: url,
                //data: data, // serializes the form's elements.
                success: function(data){
                    //console.log(data);
                    $(".ajax_loading").hide();
                    $(".panel-awal").hide();
                    $(".panel-train").show();
                    $(".panel-body-hasil").html(data);
                    /*$(".debug").html(data);
                    if(data=='success'){
                    }
                    location.reload();
                    //alert(data); // show response from the php script.
                    //console.log(data);*/

                    $(".td-error").each(function(i){
                        $(this).parent().addClass("tr-error");
                    });
                },
                beforeSend: function(){
                    $(".ajax_loading").show();
                }
            });
            return false;
        });


    });
</script>

