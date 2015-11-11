<span id="notification"></span>
<div class="table-responsive">
    <table id="item_table" class="items table table-condensed table-bordered">
        <thead style="display: none">
        <tr>
            <th></th>
            <th><?php echo lang('item'); ?></th>
            <th><?php echo lang('description'); ?></th>
            <th><?php echo lang('quantity'); ?></th>
            <th><?php echo lang('price'); ?></th>
            <th><?php echo lang('tax_rate'); ?></th>
            <th><?php echo lang('subtotal'); ?></th>
            <th><?php echo lang('tax'); ?></th>
            <th><?php echo lang('total'); ?></th>
            <th></th>
        </tr>
        </thead>

        <tbody id="new_row" style="display: none;">
         <tr>
                <td rowspan="2" class="td-icon"><i class="fa fa-arrows cursor-move"></i></td>
                <td class="td-text">
                    <input type="hidden" name="quote_id" value="<?php echo $quote_id; ?>">
                    <input type="hidden" name="item_id" value="">

                    <div class="input-group"><span  id='save'  ><a  href="#">Save Product</a></span>
                        <input type="text" name="item_name" class="input-sm form-control"
                               value="">
                    </div>
                </td>
                <td class="td-text">
                    <input type="text" name="item_sku" value=""/>
                </td>
                 <td >
                    <div class="input-group">
                        <span style="display: none" class="input-group-addon"><?php echo lang('description'); ?></span>
                        <input type="text"  name="item_description"
                                  class="input-sm form-control"/>
                    </div>
                </td>

                <td style="min-width: 20px;" class="td-amount td-quantity">
                    <div class="input-group">
                        <input type="text" name="item_quantity" class="input-sm form-control amount"
                               value="">
                    </div>
                </td>

                <td class="td-amount">
                    <div class="input-group">
                        <input type="text" name="item_price" class="input-sm form-control amount"
                               value="">
                    </div>
                </td>
                 <td class="td-amount">
                    <div class="input-group">
                        <input type="text" name="item_cost" class="input-sm form-control amount"
                               value="">
                    </div>
                </td>
                 <td style="display:none; text-align:right;" class="td-amount td-vert-middle">
                    <span name="subtotal" class="amount">
                    </span>
                </td>
                <td style="text-align:right;" class="td-amount td-vert-middle">
                    <span name="unit_profit" class="amount">
                    </span>
                </td>
                  <td style="text-align:right;" class="td-amount td-vert-middle">
                    <span name="line_profit" class="amount">
                    </span>
                </td>
                <td style="display: none;" class="td-amount ">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo lang('item_discount'); ?></span>
                        <input type="text" name="item_discount_amount" class="input-sm form-control amount"
                               value=""
                               data-toggle="tooltip" data-placement="bottom"
                               title="">
                    </div>
                </td>
                <td style="display: none;" class="td-amount">
                    <div class="input-group">
                        <select name="item_tax_rate_id" name="item_tax_rate_id"
                                class="form-control input-sm">
                            <option value="1"><?php echo "20%"; ?></option>
                        </select>
                    </div>
                </td>
                <td style="display: none;" class="td-amount td-vert-middle">
                    <span><?php echo lang('discount'); ?></span><br/>
                    <span name="item_discount_total" class="amount">
                    </span>
                </td>
                <td style="display: none; text-align: center;" class="td-amount td-vert-middle">
                    <span name="item_tax_total" class="amount">
                    </span>
                </td>
                <td style="display: none;" class="td-amount td-vert-middle">
                    <span ><?php echo lang('total'); ?></span><br/>
                    <span name="item_total" class="amount">
                    </span>
                </td>
                <td style="text-align:right;" class="td-amount td-vert-middle">
                    <span name="subtotal" class="amount">
                    </span>
                </td>
               
            </tr>
        </tbody>
        <tbody >
        
        <tr style="text-align: right;">
            <td rowspan="2" class="td-icon"><i class="fa fa-arrows cursor-move"></i></td>
            <td class="td-text"><div class="input-group">Item Name</div></td>
            <td class="td-text"><div class="input-group">SKU</div></td>
            <td class="td-amount td-quantity"><div style="text-align: right;" class="input-group">Description</div></td>
            <td><div>Quantity</div></td>
            <td class="td-input group"><div>Sale Price</div></td>
            <td><div>Unit Cost</div>
            <td style="display: none;"><div>Subtotal</div>
            <td><div>Unit Profit</div></td>
            <td><div>Line Profit</div></td>
            <td style="display: none;"><div>Tax Rate</div></td>
            <td style="display: none;"><div>Tax</div></td>
            <td><div>Subtotal</div></td>
            <td><div>&nbsp;</div></td>
        </tr>    
        </tbody>
        <?php foreach ($items as $item) { ?>
            <tbody class="item" style="text-align: right;">
           
            <tr>
                <td rowspan="2" class="td-icon"><i class="fa fa-arrows cursor-move"></i></td>
                <td class="td-text">
                    <input type="hidden" name="quote_id" value="<?php echo $quote_id; ?>">
                    <input type="hidden" name="item_id" value="<?php echo $item->item_id; ?>">

                    <div class="input-group"> 
                        <input type="text" name="item_name" class="input-sm form-control"
                               value="<?php echo html_escape($item->item_name); ?>">
                    </div>
                </td>
                 <td class="td-text">
                    <input type="text" name="item_sku" value="<?php echo @html_escape($item->item_sku); ?>"/>
                </td>
                 <td >
                    <div class="input-group">
                        <span style="display: none" class="input-group-addon"><?php echo lang('description'); ?></span>
                        <input type="text"  name="item_description" value="<?php echo $item->item_description; ?>"
                                  class="input-sm form-control"/>
                    </div>
                </td>

                <td style="min-width: 20px;" class="td-amount td-quantity">
                    <div class="input-group">
                        <input type="text" name="item_quantity" class="input-sm form-control amount"
                               value="<?php echo format_amount($item->item_quantity); ?>">
                    </div>
                </td>

                <td class="td-amount">
                    <div class="input-group">
                        <input type="text" name="item_price" class="input-sm form-control amount"
                               value="<?php echo format_amount($item->item_price); ?>">
                    </div>
                </td>
                 <td class="td-amount">
                    <div class="input-group">
                        <input type="text" name="item_cost" class="input-sm form-control amount"
                               value="<?php echo format_amount($item->item_cost); ?>">
                    </div>
                </td>
                 <td style="display: none;" style="text-align:center;" class="td-amount td-vert-middle">
                    <span name="subtotal" class="amount">
                        <?php echo format_currency($item->item_subtotal); ?>
                    </span>
                </td>
                <td style="text-align:right;" class="td-amount td-vert-middle">
                    <span name="unit_profit" class="amount">
                        <?php #echo format_currency($item->item_subtotal); ?>
                    </span>
                </td>
                  <td style="text-align:right;" class="td-amount td-vert-middle">
                    <span name="line_profit" class="amount">
                        <?php #echo format_currency($item->item_subtotal); ?>
                    </span>
                </td>
                <td style="display: none;" class="td-amount ">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo lang('item_discount'); ?></span>
                        <input type="text" name="item_discount_amount" class="input-sm form-control amount"
                               value="<?php echo format_amount($item->item_discount_amount); ?>"
                               data-toggle="tooltip" data-placement="bottom"
                               title="<?php echo $this->mdl_settings->setting('currency_symbol') . ' ' . lang('per_item'); ?>">
                    </div>
                </td>
                <td style="display: none;" class="td-amount">
                    <div class="input-group">
                        <select name="item_tax_rate_id" name="item_tax_rate_id"
                                class="form-control input-sm">
                            <option value="1"><?php echo "20%"; ?></option>
                        </select>
                    </div>
                </td>
                <td style="display: none;" class="td-amount td-vert-middle">
                    <span><?php echo lang('discount'); ?></span><br/>
                    <span name="item_discount_total" class="amount">
                        <?php echo format_currency($item->item_discount); ?>
                    </span>
                </td>
                <td style="display: none;text-align: center;" class="td-amount td-vert-middle">
                    <span name="item_tax_total" class="amount">
                        <?php echo format_currency($item->item_tax_total); ?>
                    </span>
                </td>
                <td class="td-amount td-vert-middle">
                    <span style="display: none;"><?php #echo lang('total'); ?>Subtotal</span><br/>
                    <span style="vertical-align: middle;" name="subtotal" class="amount">
                        <?php echo format_currency($item->item_subtotal); ?>
                    </span>
                </td>
                <td class="td-icon text-right td-vert-middle">
                    <a href="<?php echo site_url('quotes/delete_item/' . $quote->quote_id . '/' . $item->item_id); ?>"
                       title="<?php echo lang('delete'); ?>">
                        <i class="fa fa-trash-o text-danger"></i>
                    </a>
                </td>
               
            </tr>
            </tbody>
        <?php } ?>

    </table>
</div>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="btn-group">
            <a href="#" class="btn_add_row btn btn-sm btn-default">
                <i class="fa fa-plus"></i>
                <?php echo lang('add_new_row'); ?>
            </a>
            <a href="#" class="btn_add_product btn btn-sm btn-default">
                <i class="fa fa-database"></i>
                <?php echo lang('add_product'); ?>
            </a>
        </div>
        <br/><br/>
    </div>
    <div class="col-xs-12 col-md-6 col-md-offset-2 col-lg-4 col-lg-offset-4">
        <table class="table table-condensed text-right">
            <tr>
                <td style="width: 40%;"><?php #echo lang('subtotal'); ?>Nett Total</td>
                <td style="width: 60%;" class="amount"><?php echo format_currency($quote->quote_item_subtotal); ?></td>
            </tr>
            <tr>
                <td><?php #echo lang('item_tax'); ?>VAT</td>
                <td class="amount"><?php echo format_currency($quote->quote_item_tax_total); ?></td>
            </tr>
            <tr style="display: none;">
                <td  ><?php echo lang('quote_tax'); ?></td>
                <td>
                    <?php if ($quote_tax_rates) {
                        foreach ($quote_tax_rates as $quote_tax_rate) { ?>
                            <span class="text-muted">
                            <?php echo anchor('quotes/delete_quote_tax/' . $quote->quote_id . '/' . $quote_tax_rate->quote_tax_rate_id, '<i class="fa fa-trash-o"></i>');
                            echo ' ' . $quote_tax_rate->quote_tax_rate_name . ' ' . $quote_tax_rate->quote_tax_rate_percent; ?>
                                %</span>&nbsp;
                            <span class="amount">
                                <?php echo format_currency($quote_tax_rate->quote_tax_rate_amount); ?>
                            </span>
                        <?php }
                    } else {
                        echo format_currency('0');
                    } ?>
                </td>
            </tr>
            <tr style="display: none;">
                <td style="display: none;" class="td-vert-middle"><?php echo lang('discount'); ?></td>
                <td  class="clearfix">
                    <div class="discount-field">
                        <div class="input-group input-group-sm">
                            <input id="quote_discount_amount" name="quote_discount_amount"
                                   class="discount-option form-control input-sm amount"
                                   value="<?php echo($quote->quote_discount_amount != 0 ? $quote->quote_discount_amount : ''); ?>">

                            <div
                                class="input-group-addon"><?php echo $this->mdl_settings->setting('currency_symbol'); ?></div>
                        </div>
                    </div>
                    <div class="discount-field">
                        <div class="input-group input-group-sm">
                            <input id="quote_discount_percent" name="quote_discount_percent"
                                   value="<?php echo($quote->quote_discount_percent != 0 ? $quote->quote_discount_percent : ''); ?>"
                                   class="discount-option form-control input-sm amount">

                            <div class="input-group-addon">&percnt;</div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><b><?php #echo lang('total'); ?>GROSS</b></td>
                <td class="amount"><b><?php echo format_currency($quote->quote_total); ?></b></td>
            </tr>
            <tr>
                <td>Total Cost Price</td>
                <td class="amount"></td>
            </tr>
            <tr>
                <td>Nett Profit</td>
                <td class="amount"></td>
            </tr>
            <tr>
                <td>Profit %</td>
                 <td class="amount"></td>
             </tr>           
        </table>
    </div>
</div>