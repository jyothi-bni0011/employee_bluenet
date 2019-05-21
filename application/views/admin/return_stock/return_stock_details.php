<?= message_box('success') ?>
<?= message_box('error');
$edited = can_action('152', 'edited');
$deleted = can_action('152', 'deleted');
$paid_amount = $this->return_stock_model->calculate_to('paid_amount', $return_stock_info->return_stock_id);
$currency = $this->return_stock_model->check_by(array('code' => config_item('default_currency')), 'tbl_currencies');
$status = $return_stock_info->status;
?>

<div class="row mb">
    <div class="col-sm-10">

        <div class="btn-group">
            <button class="btn btn-xs btn-default dropdown-toggle" data-toggle="dropdown">
                <?= lang('more_actions') ?>
                <span class="caret"></span></button>
            <ul class="dropdown-menu animated zoomIn">
                <?php if ($this->return_stock_model->get_return_stock_cost($return_stock_info->return_stock_id) > 0) { ?>
                    <li>
                        <a href="<?= base_url() ?>admin/return_stock/send_return_stock_email/<?= $return_stock_info->return_stock_id ?>"
                           title="<?= lang('send') . ' ' . lang('return_stock') . ' ' . lang('email') ?>"><?= lang('send') . ' ' . lang('return_stock') . ' ' . lang('email') ?></a>
                    </li>
                    <?php if ($return_stock_info->emailed != 'Yes') { ?>
                        <li>
                            <a href="<?= base_url() ?>admin/return_stock/change_status/mark_as_sent/<?= $return_stock_info->return_stock_id ?>"
                               title="<?= lang('mark_as_sent') ?>"><?= lang('mark_as_sent') ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($return_stock_info->status == 'Cancelled' || $return_stock_info->status == 'draft') { ?>
                        <li>
                            <a href="<?= base_url() ?>admin/return_stock/change_status/pending/<?= $return_stock_info->return_stock_id ?>"
                               title="<?= lang('mark_as_pending') ?>"><?= lang('mark_as_pending') ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($return_stock_info->update_stock != 'Yes') { ?>
                        <li>
                            <a href="<?= base_url() ?>admin/return_stock/change_status/draft/<?= $return_stock_info->return_stock_id ?>"
                               title="<?= lang('mark_as_draft') ?>"><?= lang('mark_as_draft') ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($paid_amount <= 0) {
                        ?>
                        <?php if ($return_stock_info->status != 'Cancelled') { ?>
                            <li>
                                <a href="<?= base_url() ?>admin/return_stock/change_status/mark_as_cancelled/<?= $return_stock_info->return_stock_id ?>"
                                   title="<?= lang('mark_as_cancelled') ?>"><?= lang('mark_as_cancelled') ?></a>
                            </li>
                        <?php } ?>
                        <?php if ($return_stock_info->status == 'Cancelled') { ?>
                            <li>
                                <a href="<?= base_url() ?>admin/return_stock/change_status/unmark_as_cancelled/<?= $return_stock_info->return_stock_id ?>"
                                   title="<?= lang('unmark_as_cancelled') ?>"><?= lang('unmark_as_cancelled') ?></a>
                            </li>
                        <?php }
                    }
                    ?>
                <?php } ?>
                <?php if ($return_stock_info->status != 'paid') { ?>
                    <li>
                        <a href="<?= base_url() ?>admin/return_stock/change_status/paid/<?= $return_stock_info->return_stock_id ?>"
                           title="<?= lang('mark_as') . ' ' . lang('paid') ?>"><?= lang('mark_as') . ' ' . lang('paid') ?></a>
                    </li>
                <?php } ?>
                <?php if ($return_stock_info->status != 'unpaid') { ?>
                    <li>
                        <a href="<?= base_url() ?>admin/return_stock/change_status/unpaid/<?= $return_stock_info->return_stock_id ?>"
                           title="<?= lang('mark_as') . ' ' . lang('unpaid') ?>"><?= lang('mark_as') . ' ' . lang('unpaid') ?></a>
                    </li>
                <?php } ?>
                <?php if ($return_stock_info->status != 'paid') { ?>
                    <li>
                        <a href="<?= base_url() ?>admin/return_stock/change_status/accepted/<?= $return_stock_info->return_stock_id ?>"
                           title="<?= lang('mark_as') . ' ' . lang('accepted') ?>"><?= lang('mark_as') . ' ' . lang('accepted') ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>admin/return_stock/change_status/declined/<?= $return_stock_info->return_stock_id ?>"
                           title="<?= lang('mark_as') . ' ' . lang('declined') ?>"><?= lang('mark_as') . ' ' . lang('declined') ?></a>
                    </li>
                <?php } ?>
                <?php
                if (!empty($can_edit) && !empty($edited)) { ?>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= base_url() ?>admin/return_stock/index/<?= $return_stock_info->return_stock_id ?>"><?= lang('edit') . ' ' . lang('return_stock') ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="col-sm-2 pull-right">
        <a
                href="<?= base_url() ?>admin/return_stock/send_return_stock_email/<?= $return_stock_info->return_stock_id ?>"
                data-toggle="tooltip" data-placement="top" title="<?= lang('send_email') ?>"
                class="btn btn-xs btn-primary pull-right">
            <i class="fa fa-envelope-o"></i>
        </a>
        <a onclick="print_return_stock('print_return_stock')" href="#" data-toggle="tooltip" data-placement="top"
           title=""
           data-original-title="Print" class="mr-sm btn btn-xs btn-danger pull-right">
            <i class="fa fa-print"></i>
        </a>
        <a href="<?= base_url() ?>admin/return_stock/pdf_return_stock/<?= $return_stock_info->return_stock_id ?>"
           data-toggle="tooltip" data-placement="top" title="" data-original-title="PDF"
           class="btn btn-xs btn-success pull-right mr-sm">
            <i class="fa fa-file-pdf-o"></i>
        </a>
        <a href="<?= base_url() ?>admin/return_stock/index/<?= $return_stock_info->return_stock_id ?>"
           data-toggle="tooltip" data-placement="top" title="" data-original-title="<?= lang('edit') ?>"
           class="btn btn-xs btn-primary pull-right mr-sm">
            <i class="fa fa-pencil-square-o"></i>
        </a>
    </div>
</div>
<?php if (strtotime($return_stock_info->due_date) < time() AND $return_stock_info->status != ('accepted')) {
    $start = strtotime(date('Y-m-d H:i'));
    $end = strtotime($return_stock_info->due_date);

    $days_between = ceil(abs($end - $start) / 86400);
    ?>
    <div class="alert bg-danger-light hidden-print">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="fa fa-warning"></i>
        <?= lang('invoice_overdue') . ' ' . lang('by') . ' ' . $days_between . ' ' . lang('days') ?>
    </div>
    <?php
}
?>
<div class="panel" id="print_return_stock">
    <div class="panel-body mt-lg">
        <div class="row">
            <div class="col-lg-6 col-xs-6">
                <img class="pl-lg" style="width: 233px;height: 120px;"
                     src="<?= base_url() . config_item('invoice_logo') ?>">
            </div>
            <div class="col-lg-6 col-xs-6 ">
                <div class="pull-right pr-lg">
                    <h4 class="mb0"><?= lang('return_stock') . ' : ' . $return_stock_info->reference_no ?></h4>
                    <?= lang('return_stock') . ' ' . lang('date') ?>
                    : <?= display_date($return_stock_info->return_stock_date); ?>
                    <br><?= lang('due_date') ?>
                    : <?= display_date($return_stock_info->due_date); ?>
                    <?php if (!empty($return_stock_info->user_id)) { ?>
                        <br><?= lang('sales') . ' ' . lang('agent') ?>: <?php echo fullname($return_stock_info->user_id); ?>
                    <?php }
                    if ($status == ('accepted') || $status == ('paid')) {
                        $label = "success";
                    } elseif ($status == ('draft')) {
                        $label = "default";
                    } elseif ($status == ('cancelled')) {
                        $label = "danger";
                    } elseif ($status == ('declined')) {
                        $label = "warning";
                    } elseif ($status == 'sent') {
                        $label = "info";
                    } else {
                        $label = "danger";
                    }
                    ?>
                    <br><?= lang('status') ?>: <span
                            class="label label-<?= $label ?>"><?= lang($status) ?></span>
                </div>
            </div>

        </div>

        <div class="row mb-lg">
            <div class="col-lg-6 col-xs-6">
                <h5 class="p-md bg-items mr-15">
                    <?= lang('our_info') ?>:
                </h5>
                <div class="pl-sm">
                    <h4 class="mb0"><?= config_item('company_legal_name') ?></h4>
                    <?= config_item('company_address') ?>
                    <br><?= config_item('company_city') ?>
                    , <?= config_item('company_zip_code') ?>
                    <br><?= config_item('company_country') ?>
                    <br/><?= lang('phone') ?> : <?= config_item('company_phone') ?>
                    <br/><?= lang('vat_number') ?> : <?= config_item('company_vat') ?>
                </div>
            </div>
            <div class="col-lg-6 col-xs-6 ">
                <h5 class="p-md bg-items ml-13">
                    <?= lang('supplier') . ' ' . lang('info') ?>:
                </h5>
                <div class="pl-sm">
                    <?php
                    $supplier_info = get_row('tbl_suppliers', array('supplier_id' => $return_stock_info->supplier_id));
                    if (!empty($supplier_info)) {
                        $client_name = $supplier_info->name;
                        $address = $supplier_info->address;
                        $mobile = $supplier_info->mobile;
                        $phone = $supplier_info->phone;
                        $zipcode = $supplier_info->email;

                    } else {
                        $client_name = '-';
                        $address = '-';
                        $mobile = '-';
                        $zipcode = '-';
                        $country = '-';
                        $phone = '-';
                    }
                    ?>
                    <h4 class="mb0"><?= $client_name ?></h4>
                    <?= $address ?>
                    <br> <?= $zipcode ?>
                    <br><?= lang('phone') ?>: <?= $phone ?>
                    <br><?= lang('mobile') ?>: <?= $mobile ?>
                    <?php if (!empty($supplier_info->tax)) { ?>
                        <br><?= lang('tax') ?>: <?= $supplier_info->tax ?>
                    <?php } ?>
                </div>
            </div>

        </div>
        <style type="text/css">
            .dragger {
                background: url(<?= base_url()?>assets/img/dragger.png) 0px 11px no-repeat;
                cursor: pointer;
            }

            .table > tbody > tr > td {
                vertical-align: initial;
            }
        </style>

        <div class="table-responsive mb-lg">
            <table class="table items return_stock-items-preview" page-break-inside: auto;>
                <thead class="bg-items">
                <tr>
                    <th>#</th>
                    <th><?= lang('items') ?></th>
                    <?php
                    $invoice_view = config_item('invoice_view');
                    if (!empty($invoice_view) && $invoice_view == '2') {
                        ?>
                        <th><?= lang('hsn_code') ?></th>
                    <?php } ?>
                    <?php
                    $qty_heading = lang('qty');
                    if (isset($return_stock_info) && $return_stock_info->show_quantity_as == 'hours' || isset($hours_quantity)) {
                        $qty_heading = lang('hours');
                    } else if (isset($return_stock_info) && $return_stock_info->show_quantity_as == 'qty_hours') {
                        $qty_heading = lang('qty') . '/' . lang('hours');
                    }
                    ?>
                    <th><?php echo $qty_heading; ?></th>
                    <th class="col-sm-1"><?= lang('price') ?></th>
                    <th class="col-sm-2"><?= lang('tax') ?></th>
                    <th class="col-sm-1"><?= lang('total') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $invoice_items = $this->return_stock_model->ordered_items_by_id($return_stock_info->return_stock_id);
                if (!empty($invoice_items)) :
                    foreach ($invoice_items as $key => $v_item) :
                        $item_name = $v_item->item_name ? $v_item->item_name : strip_html_tags($v_item->item_desc);
                        $item_tax_name = json_decode($v_item->item_tax_name);
                        ?>
                        <tr class="sortable item" data-item-id="<?= $v_item->items_id ?>">
                            <td class="item_no dragger pl-lg"><?= $key + 1 ?></td>
                            <td><strong class="block"><?= $item_name ?></strong>
                                <?= strip_html_tags($v_item->item_desc) ?>
                            </td>
                            <?php
                            $invoice_view = config_item('invoice_view');
                            if (!empty($invoice_view) && $invoice_view == '2') {
                                ?>
                                <td><?= $v_item->hsn_code ?></td>
                            <?php } ?>
                            <td><?= $v_item->quantity . '   &nbsp' . $v_item->unit ?></td>
                            <td><?= display_money($v_item->unit_cost) ?></td>
                            <td><?php
                                if (!empty($item_tax_name)) {
                                    foreach ($item_tax_name as $v_tax_name) {
                                        $i_tax_name = explode('|', $v_tax_name);
                                        echo '<small class="pr-sm">' . $i_tax_name[0] . ' (' . $i_tax_name[1] . ' %)' . '</small>' . display_money($v_item->total_cost / 100 * $i_tax_name[1]) . ' <br>';
                                    }
                                }
                                ?></td>
                            <td><?= display_money($v_item->total_cost) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8"><?= lang('nothing_to_display') ?></td>
                    </tr>
                <?php endif ?>
                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top: 35px">
            <div class="col-xs-8">
                <p class="well well-sm mt">
                    <?= $return_stock_info->notes ?>
                </p>
            </div>
            <div class="col-sm-4 pv">
                <div class="clearfix">
                    <p class="pull-left"><?= lang('sub_total') ?></p>
                    <p class="pull-right mr">
                        <?= display_money($this->return_stock_model->calculate_to('invoice_cost', $return_stock_info->return_stock_id)); ?>
                    </p>
                </div>
                <?php if ($return_stock_info->discount_total > 0): ?>
                    <div class="clearfix">
                        <p class="pull-left"><?= lang('discount') ?>
                            (<?php echo $return_stock_info->discount_percent; ?>
                            %)</p>
                        <p class="pull-right mr">
                            <?= display_money($this->return_stock_model->calculate_to('discount', $return_stock_info->return_stock_id)); ?>
                        </p>
                    </div>
                <?php endif ?>
                <?php
                $tax_info = json_decode($return_stock_info->total_tax);
                $tax_total = 0;
                if (!empty($tax_info)) {
                    $tax_name = $tax_info->tax_name;
                    $total_tax = $tax_info->total_tax;
                    if (!empty($tax_name)) {
                        foreach ($tax_name as $t_key => $v_tax_info) {
                            $tax = explode('|', $v_tax_info);
                            $tax_total += $total_tax[$t_key];
                            ?>
                            <div class="clearfix">
                                <p class="pull-left"><?= $tax[0] . ' (' . $tax[1] . ' %)' ?></p>
                                <p class="pull-right mr">
                                    <?= display_money($total_tax[$t_key]); ?>
                                </p>
                            </div>
                        <?php }
                    }
                } ?>
                <?php if ($tax_total > 0): ?>
                    <div class="clearfix">
                        <p class="pull-left"><?= lang('total') . ' ' . lang('tax') ?></p>
                        <p class="pull-right mr">
                            <?= display_money($tax_total); ?>
                        </p>
                    </div>
                <?php endif ?>
                <?php if ($return_stock_info->adjustment > 0): ?>
                    <div class="clearfix">
                        <p class="pull-left"><?= lang('adjustment') ?></p>
                        <p class="pull-right mr">
                            <?= display_money($return_stock_info->adjustment); ?>
                        </p>
                    </div>
                <?php endif ?>

                <div class="clearfix">
                    <p class="pull-left"><?= lang('total') ?></p>
                    <p class="pull-right mr">
                        <?= display_money($this->return_stock_model->calculate_to('total', $return_stock_info->return_stock_id), $currency->symbol); ?>
                    </p>
                </div>

                <?php

                if ($paid_amount > 0) {
                    $total = lang('total_due');
                    if ($paid_amount > 0) {
                        $text = 'text-danger';
                        ?>
                        <div class="clearfix">
                            <p class="pull-left"><?= lang('paid_amount') ?> </p>
                            <p class="pull-right mr">
                                <?= display_money($paid_amount, $currency->symbol); ?>
                            </p>
                        </div>
                    <?php } else {
                        $text = '';
                    } ?>
                    <div class="clearfix">
                        <p class="pull-left h3 <?= $text ?>"><?= $total ?></p>
                        <p class="pull-right mr h3"><?= display_money($this->return_stock_model->calculate_to('return_stock_due', $return_stock_info->return_stock_id), $currency->symbol); ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?= !empty($invoice_view) && $invoice_view > 0 ? $this->gst->summary($invoice_items) : ''; ?>
</div>

<?php include_once 'assets/js/sales.php'; ?>

<script type="text/javascript">
    $(document).ready(function () {
        init_items_sortable(true);
    });

    function print_return_stock(print_return_stock) {
        var printContents = document.getElementById(print_return_stock).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>