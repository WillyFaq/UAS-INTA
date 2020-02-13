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
                    <?= isset($attr)?$attr:'';?>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-2">
                            <button type="submit" class="btn btn-success" style="width:100%; ">Ambil Data</button>
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
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Aksi</h3>
            </div>
            <div class="panel-body">
                <input type="submit" class="btn btn-default" name="tokenizing" value="Tokenizing">
                <input type="submit" class="btn btn-primary" name="case_folding" value="Case Folding">
                <input type="submit" class="btn btn-warning" name="hapus_tanda_baca" value="Hapus Tanda Baca">
                <input type="submit" class="btn btn-warning" name="hapus_emoticon" value="Hapus Emoticon">
                <input type="submit" class="btn btn-warning" name="hapus_kata_tanya" value="Hapus Kata Tanya">
                <input type="submit" class="btn btn-danger"  name="stopword_removed" value="Stopword Removed">
                <input type="submit" class="btn btn-success" name="stemming" value="Stemming">
            </div>
        </div>
        <?php if($tittle=='Source 1 : Twitter'): ?>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Aksi 2</h3>
            </div>
            <div class="panel-body">
                <input type="submit" class="btn btn-success" name="process" value="Text Preprocessing">
            </div>
        </div>  
        <?php endif; ?>
        </form>
        <?php endif; ?>
        
        
        
        <?php if(isset($hasil)): ?>
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Hasil</h3>
            </div>
            <div class="panel-body">
                <?= $hasil; ?>
            </div>
        </div>
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