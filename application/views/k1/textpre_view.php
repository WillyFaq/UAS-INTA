<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $tittle; ?><br>
        <small><?= $subtittle; ?></small>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Data</h3>
            </div>
            <div class="panel-body">

                <?= form_open($form.'/proses');?>
                <?= isset($table_data)?$table_data:''; ?>
                <input type="button" class="btn btn-success pull-right btnproses" name="process" value="Process">
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <!-- 
        <pre class="debug"></pre>
         -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var table = $('.datatab_form').DataTable({
                'columnDefs': [
                    {
                        'targets': 1,
                        'checkboxes': {
                           'selectRow': true
                        },
                        'render': function (data, type, full, meta){
                            return '<input type="checkbox" class="dt-checkboxes" name="pilih[]" value="' + $('<div/>').text(data).html() + '">';
                         }
                    }
                ],
                'select': {
                    'style': 'multi'
                },
                'order': [[1, 'asc']]
        });
 
        
        $('.btnproses').click( function() {
            var data = table.$('input').serialize();
            var url = '<?= base_url("k1/textpre/proses");?>';
            $.ajax({
                type: "POST",
                url: url,
                data: data, // serializes the form's elements.
                success: function(data){
                    $(".ajax_loading").hide();
                    $(".debug").html(data);
                    if(data=='success'){
                    }
                    location.reload();
                    //alert(data); // show response from the php script.
                    //console.log(data);
                },
                beforeSend: function(){
                    $(".ajax_loading").show();
                }
            });

            /*alert(
                "The following data would have been submitted to the server: \n\n"+
                data.substr( 0, 120 )+'...'
            );*/
            return false;
        });
    });
</script>

