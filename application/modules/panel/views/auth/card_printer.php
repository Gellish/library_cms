<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?= base_url();?>assets/dist/css/barcode_print.css">
<style type="text/css">
.padding05{
    padding-right: 5px;
}
.table.barcodes td {
padding: 30px 20px !important;
}
.table.barcodes .table-barcode {
    width: 100%;
}
.table.barcodes .table-barcode td {
    border-bottom: 1px solid #eee;
    padding: 3px !important;
}

.table th, .table td { vertical-align: middle !important; }
.table > thead:first-child > tr:first-child > th, .table > thead:first-child > tr:first-child > td, .table-striped thead tr.primary:nth-child(odd) th {
    background-color: #428BCA;
    color: white;
    border-color: #357EBD;
    border-top: 1px solid #357EBD;
    text-align: center;
}
.table-responsive { margin-bottom: 0; }
.table-responsive .form-inline select.form-control {
    width: auto;
}
.table-responsive .form-inline select.form-control option {
    padding: 0;
}
.table-hover > tbody > tr:hover > td,
.table-hover > tbody > tr:hover > th {
    background-color:#D9EDF7;
    border-color: #AFD9EE;
}
.table-hover > tbody > tr.warning:hover > td,
.table-hover > tbody > tr.warning:hover > th {
    border-color: #F0E1A0;
}
.table-hover > tbody > tr.danger:hover > td,
.table-hover > tbody > tr.danger:hover > th {
    border-color: #ebbbbb;
}
.nav-tabs > li.active > a.tab-grey, .nav-tabs > li.active > a.tab-grey:hover, .nav-tabs > li.active > a.tab-grey:focus {
    background-color: #F7F7F8;
}
.table-borderless > thead > tr > th,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > tbody > tr > td,
.table-borderless > tfoot > tr > td {
  border-top: none;
}
.table td p:last-child {
    margin-bottom: 0;
}
    /* =================================================================== */
.card { width: 353px; min-height: 200px; border-radius: 10px; margin: 15px auto; color: #FFF; }
.card .card_img { position: absolute; top: 0; left: 0; width: 353px; height: 206px; }
.card .front { position: relative; }
.card .back {  position: relative; }
.card .middle { display: table-cell; vertical-align: middle; width: 353px; height: 206px; }
.card .card-content { position: absolute; top: 0; left: 0; z-index: 55555; height: 206px; width: 100%; display: block; padding: 10px; text-align: center; }

.barcode .style10 {
    width: 4in;
    height: 5in;
}

@media print {
    @page {
        margin: 0;
    }
}
</style>
<div class="box">
    <div class="box-header with-border no-print">
      <h3 class="box-title"><i class="fa-fw fa fa-plus"></i><?= lang('print_barcode_title'); ?></h3><br>
      <div class="box-tools pull-right">
        <button type="button" class="btn" onclick="customPrint();" id="print-icon" title="<?= lang('print_label'); ?>"><i class="icon fa fa-print"></i>
        </button>
      </div>
    </div>
   
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="well well-sm no-print">
                    <div class="form-group">
                        <label><?= lang('add_book_label'); ?></label>
                        <?php echo form_input('add_item', '', 'class="form-control" id="add_item" placeholder="' . $this->lang->line("add_item") . '"'); ?>
                    </div>
                    <?= form_open("panel/auth/card_printer", 'id="barcode-print-form" data-toggle="validator"'); ?>
                    <div class="controls table-controls">
                        <table id="bcTable"
                               class="table items table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th class="col-xs-8">User (Email)</th>
                                    <th class="col-xs-1 text-center" style="width:30px;">
                                        <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                        <div class="form-group">
                            <label><?= lang('style');?></label>
                           <?php $opts = array('' => lang('select').' '.lang('style'),
                            10 => lang('10_per_sheet'), 
                            50 => lang('continuous_feed')); ?>
                            <?= form_dropdown('style', $opts, set_value('style', 24), 'class="form-control tip" id="style" required="required"'); ?>
                            <div class="row cf-con" style="margin-top: 10px; display: none;">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <?= form_input('cf_width', '', 'class="form-control" id="cf_width" placeholder="' . lang("width") . '"'); ?>
                                            <span class="input-group-addon" style="padding-left:10px;padding-right:10px;"><?= lang('inches'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <?= form_input('cf_height', '', 'class="form-control" id="cf_height" placeholder="' . lang("height") . '"'); ?>
                                            <span class="input-group-addon" style="padding-left:10px;padding-right:10px;">
                                                <?= lang('inches'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                    <?php $oopts = array(0 => lang('portrait'), 1 => lang('landscape')); ?>
                                        <?= form_dropdown('cf_orientation', $oopts , '', 'class="form-control" id="cf_orientation" placeholder="' . lang("orientation") . '"'); ?>
                                    </div>
                                </div>
                            </div>
                            <span class="help-block"><?= lang('barcode_tip'); ?></span>
                            <span class="aflinks pull-right">
                                <a href="https://www.a4labels.com" target="_blank">A4Lables.com</a> |
                                <a href="https://www.a4labels.com/products/white-self-adhesive-printer-labels-63-5-x-72mm/23585" target="_blank">12 per sheet</a> |
                                <a href="https://www.a4labels.com/products/white-self-adhesive-printer-labels-63-x-47mm/23586" target="_blank">18 per sheet</a> |
                                <a href="https://www.a4labels.com/products/white-self-adhesive-printer-labels-63-x-34mm/23588" target="_blank">24 per sheet</a> |
                                <a href="https://www.a4labels.com/products/white-self-adhesive-printer-labels-46-x-25mm/23587" target="_blank">40 per sheet</a>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    <div class="form-group">
                        <?php echo form_submit('print', lang('update'), 'class="btn btn-primary"'); ?>
                        <button type="button" id="reset" class="btn btn-danger"><?= lang('reset'); ?></button>
                    </div>
                    <?= form_close(); ?>
                    <div class="clearfix"></div>
                </div>
                <div id="barcode-con">
                    <?php
                        if ($this->input->post('print')) {
                            if (!empty($barcodes)) {
                                echo '<button type="button" onclick="customPrint();" class="btn btn-primary btn-block no-print" title="'.'Print'.'"><i class="icon fa fa-print"></i> '.'Print'.'</button>';
                                $c = 1;
                                if ($style == 12 || $style == 18 || $style == 24 || $style == 40) {
                                    echo '<div class="barcodea4">';
                                } elseif ($style != 50) {
                                    echo '<div class="barcode">';
                                }
                                foreach ($barcodes as $item) {
                                    for ($r = 1; $r <= $item->quantity; $r++) {
                                        echo '<div class="item style'.$style.'" '.
                                        ($style == 50 && $this->input->post('cf_width') && $this->input->post('cf_height') ?
                                            'style="width:'.$this->input->post('cf_width').'in;height:'.$this->input->post('cf_height').'in;border:0;"' : '')
                                        .'>';
                                        if ($style == 50) {
                                            if ($this->input->post('cf_orientation')) {
                                                $ty = (($this->input->post('cf_height')/$this->input->post('cf_width'))*100).'%';
                                                $landscape = '
                                                -webkit-transform-origin: 0 0;
                                                -moz-transform-origin:    0 0;
                                                -ms-transform-origin:     0 0;
                                                transform-origin:         0 0;
                                                -webkit-transform: translateY('.$ty.') rotate(-90deg);
                                                -moz-transform:    translateY('.$ty.') rotate(-90deg);
                                                -ms-transform:     translateY('.$ty.') rotate(-90deg);
                                                transform:         translateY('.$ty.') rotate(-90deg);
                                                ';
                                                echo '<div class="div50" style="width:'.$this->input->post('cf_height').'in;height:'.$this->input->post('cf_width').'in;border: 1px dotted #CCC;'.$landscape.'">';
                                            } else {
                                                echo '<div class="div50" style="width:'.$this->input->post('cf_width').'in;height:'.$this->input->post('cf_height').'in;border: 1px dotted #CCC;padding-top:0.025in;">';
                                            }
                                        }
                                        ?>
                                        <div class="card">
                                            <div class="front">
                                                <img src="<?= base_url(); ?>assets/card.png" alt="" class="card_img">
                                                <div class="card-content white-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="353px" height="206px" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <text x="5"  y="20" style="font-size:16;fill:#FFF;">
                                                        <!-- Usman Sher -->
                                                        </text>
                                                        <text x="185"  y="20" style="font-size:16;fill:#FFF;">
                                                       
                                                        </text>
                                                        <text x="5"  y="75" style="font-size:36;fill:#FFF;">
                                                        <?= $item->pname;?>
                                                        </text>
                                                        <text x="5"  y="105" style="font-size:16;fill:#FFF;">
                                                        <?= $item->borrowertype?>
                                                        </text>
                                                        <text x="5"  y="125" style="font-size:16;fill:#FFF;">
                                                        <?= $item->class?> <?= ($item->class != '' or !$item->section == NULL) ? $item->section : ''?>
                                                        </text>
                                                        <image xlink:href="<?= base_url() ?>assets/uploads/members/<?= $item->image; ?>" x="240" y="20" height="100" width="100" /> 

                                                        <image xlink:href="<?= base_url() ?>panel/books/gen_barcode/<?= $item->member_unique_id; ?>" x="110" y="50" height="230" width="230" /> 
                                                      
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="back">
                                                <img src="<?= base_url();?>assets/card.png" alt="" class="card_img">
                                                <div class="card-content">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="353px" height="206px" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <image xlink:href="<?= base_url() ?>assets/uploads/logos/<?= $settings->logo; ?>" x="60" y="0" height="180" width="180" /> 
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        // print_r($item);
                                        if ($style == 50) {
                                            echo '</div>';
                                        }
                                        echo '</div>';
                                        if ($style == 40) {
                                            if ($c % 40 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                            }
                                        } elseif ($style == 30) {
                                            if ($c % 30 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcode">';
                                            }
                                        } elseif ($style == 24) {
                                            if ($c % 24 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                            }
                                        } elseif ($style == 20) {
                                            if ($c % 20 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcode">';
                                            }
                                        } elseif ($style == 18) {
                                            if ($c % 18 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                            }
                                        } elseif ($style == 14) {
                                            if ($c % 14 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcode">';
                                            }
                                        } elseif ($style == 12) {
                                            if ($c % 12 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                            }
                                        } elseif ($style == 10) {
                                            if ($c % 4 == 0) {
                                                echo '</div><div class="clearfix"></div><div class="barcode">';
                                            }
                                        }
                                        $c++;
                                    }
                                }
                                if ($style != 50) {
                                    echo '</div>';
                                }
                                echo '<button type="button" onclick="customPrint();" class="btn btn-primary btn-block  no-print" title="'.lang('print_label').'"><i class="icon fa fa-print"></i> '.lang('print_label').'</button>';
                            } else {
                                echo '<h3>'.lang('no_book_selected').'</h3>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var ac = false; ucitems = {};
    if (localStorage.getItem('ucitems')) {
        ucitems = JSON.parse(localStorage.getItem('ucitems'));
    }
    <?php if($items) { ?>
    localStorage.setItem('ucitems', JSON.stringify(<?= $items; ?>));
    <?php } ?>
    $(document).ready(function() {
        <?php if ($this->input->post('print')) { ?>
            $( window ).load(function() {
                $('html, body').animate({
                    scrollTop: ($("#barcode-con").offset().top)-15
                }, 1000);
            });
        <?php } ?>
        if (localStorage.getItem('ucitems')) {
            loadItems();
        }
        $("#add_item").autocomplete({
            source: '<?= site_url('panel/auth/get_suggestions'); ?>',
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert('No User Found');
                    $('#add_item').focus();
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert('No User Found');
                    $('#add_item').focus();
                    $(this).val('');
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                if (ui.item.id !== 0) {
                    var row = add_product_item(ui.item);
                    if (row) {
                        $(this).val('');
                    }
                } else {
                    alert('<?= lang('no_book_found'); ?>');
                }
            }
        });
        check_add_item_val();

        $('#style').change(function (e) {
            localStorage.setItem('bcstyle', $(this).val());
            if ($(this).val() == 50) {
                $('.cf-con').slideDown();
            } else {
                $('.cf-con').slideUp();
            }
        });
        if (style = localStorage.getItem('bcstyle')) {
            $('#style').val(style);
            if (style == 50) {
                $('.cf-con').slideDown();
            } else {
                $('.cf-con').slideUp();
            }
        }

        $('#cf_width').change(function (e) {
            localStorage.setItem('cf_width', $(this).val());
        });
        if (cf_width = localStorage.getItem('cf_width')) {
            $('#cf_width').val(cf_width);
        }

        $('#cf_height').change(function (e) {
            localStorage.setItem('cf_height', $(this).val());
        });
        if (cf_height = localStorage.getItem('cf_height')) {
            $('#cf_height').val(cf_height);
        }

        $('#cf_orientation').change(function (e) {
            localStorage.setItem('cf_orientation', $(this).val());
        });
        if (cf_orientation = localStorage.getItem('cf_orientation')) {
            $('#cf_orientation').val(cf_orientation);
        }

       
        $('#reset').click(function (e) {
            if (confirm("Are You Sure")) {
                if (localStorage.getItem('ucitems')) {
                    localStorage.removeItem('ucitems');
                }
                if (localStorage.getItem('bcstyle')) {
                    localStorage.removeItem('bcstyle');
                }
                if (localStorage.getItem('bcsite_name')) {
                    localStorage.removeItem('bcsite_name');
                }
                if (localStorage.getItem('bcproduct_name')) {
                    localStorage.removeItem('bcproduct_name');
                }
                if (localStorage.getItem('bcprice')) {
                    localStorage.removeItem('bcprice');
                }
                if (localStorage.getItem('bcunit')) {
                    localStorage.removeItem('bcunit');
                }
                if (localStorage.getItem('bccategory')) {
                    localStorage.removeItem('bccategory');
                }
                if (localStorage.getItem('bcauthor')) {
                    localStorage.removeItem('bcauthor');
                }
                $('#modal-loading').show();
                window.location.replace("<?= site_url('panel/books/print_barcodes'); ?>");
            }
        });
    });

    function add_product_item(item) {
        ac = true;
        if (item == null) {
            return false;
        }
        item_id = item.id;
        ucitems[item_id] = item;
        localStorage.setItem('ucitems', JSON.stringify(ucitems));
        loadItems();
        return true;
    }

    function loadItems () {
        if (localStorage.getItem('ucitems')) {
            $("#bcTable tbody").empty();
            ucitems = JSON.parse(localStorage.getItem('ucitems'));
            $.each(ucitems, function () {
                var item = this;
                var row_no = item.id;
                var newTr = $('<tr id="row_' + row_no + '" class="row_' + item.id + '" data-item-id="' + item.id + '"></tr>');
                tr_html = '<td><input name="product[]" type="hidden" value="' + item.id + '"><span id="name_' + row_no + '">' + item.name + ' (' + item.email + ')</span></td>';
                tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + row_no + '" title="Remove" style="cursor:pointer;"></i></td>';
                newTr.html(tr_html);
                newTr.appendTo("#bcTable");
            });
            $('input[type="checkbox"],[type="radio"]').not('.skip').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
            return true;
        }
    }

    function check_add_item_val() {
        $('#add_item').bind('keypress', function (e) {
            if (e.keyCode == 13 || e.keyCode == 9) {
                e.preventDefault();
                $(this).autocomplete("search");
            }
        });
    }
    function customPrint() {
        var rightSide = document.getElementById("content-wrapper");
        var oldMargin = rightSide.style.marginLeft;
        rightSide.style.marginLeft = "0";

        var rightSide2 = document.getElementsByClassName("content")[0];
        var oldMargin2 = rightSide2.style.paddingLeft;
        rightSide2.style.paddingLeft = "0";
        window.print();
        rightSide.style.marginLeft = oldMargin;
        rightSide2.style.paddingLeft = oldMargin2;
    }
</script>