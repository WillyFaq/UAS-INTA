<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $tittle; ?><br>
        <small><?= $subtittle; ?></small>
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Data dalam json file</h3>
            </div>
            <div class="panel-body">
				<?= isset($table)?$table:''; ?>
            </div>
        </div>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Sorting</h3>
            </div>
            <div class="panel-body">

        		<?= form_open($form.'/proses');?>
				<?= isset($table_data)?$table_data:''; ?>
				<input type="button" class="btn btn-success pull-right btnproses" name="process" value="Process">
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        var table = $('.datatab_form').DataTable(/*{
            columnDefs: [{
                orderable: false,
                targets: [1,2,3]
            }]
        }*/);
 
        $('.btnproses').click( function() {
            var data = table.$('input').serialize();
            console.log(data);
            var url = '<?= base_url("k1/sort/proses");?>';
            $.ajax({
                type: "POST",
                url: url,
                data: data, // serializes the form's elements.
                success: function(data){
                   //alert(data); // show response from the php script.
                    console.log(data);
                    if(data=='success'){
                    	document.location="<?= base_url('k1/sort'); ?>";
                    }
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