<style type="text/css">

.bcimg{
  width: 40px;
}
</style>
<script>
    base_url = <?php echo json_encode(base_url()); ?>;
    function img_hl(x) {
        if (x.substring(0, 7) == 'uploads') {
            return "<img style='width:20px; height:30px;' src=" + base_url + x +">";
            
        }else{
          return "<img style='width:20px; height:30px;' src=" + base_url + 'assets/uploads/book_covers/' + x +">";
        }
    }
    function isPdf(x) {
      var div = document.createElement('div');
      div.innerHTML = x // Make it a complete tag
      var link = div.firstChild.getAttribute("href");
      var title = div.firstChild.getAttribute("title");

      if (title == null || title == '') {
        return "Not Available";
      }else{
        return "<a href='"+link+"'>Read</a>";
        
      }
    }
    function actions(x) {
      <?php  
        if ( $this->ion_auth->in_group(array('webmaster', 'admin')) ){
      ?> 
      return x;
      <?php }else{ ?>
        return ""
      <?php } ?>
    }
    function bkFormat(x) {
        if (x != null) {
            var d = '', pqc = x.split("___");
            d = '<strong>' + pqc[0] + '</strong><br>';
            if (pqc[1]) {
                d += '<strong><?= lang('publisher_label'); ?>: </strong>'+pqc[1] + '<br>';
            }
            if (pqc[2]) {
                d += '<strong><?= lang('author_label'); ?>: </strong>' + pqc[2] + '<br>';
            }
            return d;
        } else {
            return '';
        }
    }
    function pqFormat(x) {
      var d = '', pqc = x.split(",");
      return x;
    }
    function price(x) {
      return '<?= $settings->currency; ?>'+x;
    }

    $(document).ready(function () {
        var oTable = $('#PRData').dataTable({
            "aaSorting": [[3, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('panel/books/getBooks') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            }, 
            // "columnDefs": [
            //   { "width": '20%', "targets": 0 }
            // ],
            // "fixedColumns": true,
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData['id'];
                nRow.className = "book_link";
                //if(aData[7] > aData[9]){ nRow.className = "product_link warning"; } else { nRow.className = "product_link"; }
                return nRow;
            },
            "aoColumns": [{
                "bSearchable_": false,
                "data": "image",
                "mRender": img_hl,
                "bSortable": false,
            }, {
                "data": "book_title",
                "name": "book_title",
                "mRender": bkFormat,

            },{
                "data": "category_name",
                "name": "category_name",
            },{
                "data": "total_quantity",
                "name": "total_quantity",

            },{
                "data": "available",
                "name": "available",

            }, {
                "data": "price",
                "name": "books.price",
            },  
            { 
                "data": "read", 
                "name": "read", 
                "bSortable": false,
                "mRender": isPdf,

             },
             ],
           
        });
              
    });
     
</script>
 <!-- Content Header (Page header) -->
   
      <!-- Small boxes (Stat box) -->
 <!-- Main content -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <span style="font-size: 20px; margin-right: 10px;"><?= lang('book_listing_label'); ?></span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="PRData" style="width: 100%;" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th><?= lang('image_label'); ?></th>
                  <th><?= lang('book_label'); ?></th>
                  <th><?= lang('category_label'); ?></th>
                  <th><?= lang('qty_label'); ?></th>
                  <th><?= lang('avail_label'); ?></th>
                  <th><?= lang('price_label'); ?></th>
                  <th><?= lang('read_label'); ?></th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="2" class="dataTables_empty"><?= lang('loading'); ?></td>
                        </tr>
                </tbody>
                <tfoot>
                <tr>
                  <!-- <th>#</th> -->
                  <th><?= lang('image_label'); ?></th>
                  <th><?= lang('book_label'); ?></th>
                  <th><?= lang('category_label'); ?></th>
                  <th><?= lang('qty_label'); ?></th>
                  <th><?= lang('avail_label'); ?></th>
                  <th><?= lang('price_label'); ?></th>
                  <th><?= lang('read_label'); ?></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>