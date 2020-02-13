<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $tittle; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">Atribut</h3>
            </div>
            <div class="panel-body">
                <?= form_open($form.'/show_data', array("class" => "form-horizontal"));?>
                <div class="row">
                    <div class="col-xs-6 text-center">
                        <h4>Attribut Source 1 : twitter</h4>
                        <hr>
                        <?= isset($attr)?$attr['twiiter']:'';?>
                    </div>
                    <div class="col-xs-6 text-center">
                        <h4>Attribut Source 2 : selular.id</h4>
                        <hr>
                        <?= isset($attr)?$attr['selular']:'';?>
                    </div>
                    <div class="col-xs-12 text-center">
                        <hr>
                        <button type="submit" class="btn btn-success" >Ambil Data</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        
        <?php if(isset($table)): ?>
        <?= form_open($form.'/show_hasil');?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Data</h3>
            </div>
            <div class="panel-body">
                <?= $table; ?>
            </div>
        </div>
        <?php
        if(isset($attr_sel)){
            foreach ($attr_sel as $key => $value) {
                if($value != 'Aksi'){
                    //echo '$("#chb_'.$value.'").attr("checked", true);';
                    echo '<input type="hidden" name="attr[]" value="'.$value.'" >';
                }
            }    
        }
        ?>
        
        </form>
        <?php endif; ?>



    </div>
</div>

        
<br>        
<hr>        
<br>        


<script type="text/javascript">
    $(document).ready(function(){
        var review = [];
        $(".review-txt").each(function(){
            var txt = $(this).html();
            var id = $(this).attr("id");
            id = id.split("-")[1];
            //console.log(id);
            //review.push(txt);
            review[id] = txt;
            $(this).html(txt.substr(0, 200)+"...");
        });
        

        $(".read_more").click(function(){
            var id = $(this).attr("data-id");
            var view = $(this).attr("data-view");
            if(view==0){
                $("#rev-"+id).html(review[id]);
                console.log(review[id]);
                $(this).attr("data-view", 1);
                $(this).html("Hide");
            }else{
                $("#rev-"+id).html(review[id].substr(0, 200)+"...");
                $(this).attr("data-view", 0);
                $(this).html("Read More");
            }
            return false;

        });


        <?php

        if(isset($attr_sel)){
            foreach ($attr_sel as $key => $value) {
                if($value != 'Aksi'){
                    echo '$("#chb_'.$value.'").attr("checked", true);';
                }
            }    
        }
        if(isset($idata)){
            foreach ($idata as $key => $value) {
                if($value != 'Aksi'){
                    echo '$("#chb-'.$value.'").attr("checked", true);';
                    //echo 'console.log()';
                }
            }    
        }
        ?>
    });
</script>