<script type="text/javascript">
    $(function () {
        // Display the create invoice modal
        $('#modal-choose-items').modal('show');

        // Creates the invoice
        $('.select-items-confirm').click(function () {
            var product_ids = [];

            $("input[name='product_ids[]']:checked").each(function () {
                product_ids.push(parseInt($(this).val()));
            });

            $.post("<?php echo site_url('products/ajax/process_product_selections'); ?>", {
                product_ids: product_ids
            }, function (data) {
                items = JSON.parse(data);

                for (var key in items) {
                    // Set default tax rate id if empty
                    if (!items[key].tax_rate_id) items[key].tax_rate_id = 0;

                    if ($('#item_table tbody:last input[name=item_name]').val() !== '') {
                        $('#new_row').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
                    }
                    $('#item_table tbody:last input[name=item_name]').val(items[key].product_name);
                    $('#item_table tbody:last input[name=item_description]').val(items[key].product_description);
                    $('#item_table tbody:last input[name=item_price]').val(items[key].product_price);
                    $('#item_table tbody:last input[name=item_quantity]').val('1');
                    $('#item_table tbody:last select[name=item_tax_rate_id]').val(items[key].tax_rate_id);
                    $('#item_table tbody:last input[name=item_cost]').val(items[key].purchase_price);
                    $('#item_table tbody:last').find('#save').remove();
                    $('#modal-choose-items').modal('hide');
                }

                $(function()
            {

                var item_row = 1;
                var results = Array();

                $('#item_table').find('.ui-sortable-handle').each(function() {
                    results[item_row] = [];
                        $( this ).find('input').each(function()
                            {
                                if (this.getAttribute('name') == 'item_quantity' || this.getAttribute('name') == 'item_price' || 
                                    this.getAttribute('name') == 'item_cost'){
                                    if (this.value) 
                                        {                                   
                                            results[item_row][this.getAttribute('name')] = this.value;
                                            
                                        }//if value is non-null 
                                    } //if attr name quantity or price
                            }); //input loop

                        $( this ).find('span').each(function(){
                                if (this.getAttribute('name') == 'subtotal' 
                                    && results[item_row]['item_quantity'] 
                                    && results[item_row]['item_price'])
                                        {
                                            subtotal = results[item_row]['item_quantity'] * results[item_row]['item_price'];
                                            this.innerHTML = "£" + (Math.round(subtotal * 100) / 100).toFixed(2);
                                        }
                                        
                                if (this.getAttribute('name') == 'item_tax_total' 
                                    && results[item_row]['item_quantity'] 
                                    && results[item_row]['item_price'])
                                        {
                                            tax = (results[item_row]['item_quantity'] * results[item_row]['item_price'])/5;
                                            this.innerHTML = "£" + tax;
                                        }   

                                if (this.getAttribute('name') == 'item_total' 
                                    && results[item_row]['item_quantity'] 
                                    && results[item_row]['item_price'])
                                        {
                                            item_total = results[item_row]['item_quantity'] * results[item_row]['item_price'] 
                                                         + (results[item_row]['item_quantity'] * results[item_row]['item_price'])/5;
                                            this.innerHTML = "£" + (Math.round(item_total * 100) /100).toFixed(2);
                                        }       
                                if (this.getAttribute('name') == 'unit_profit' 
                                    && results[item_row]['item_price']
                                    && results[item_row]['item_cost'])
                                        {

                                            unit_profit = results[item_row]['item_price'] - results[item_row]['item_cost'];
                                            this.innerHTML = "£" + (Math.round(unit_profit * 100) / 100).toFixed(2);
                                        }
                                if (this.getAttribute('name') == 'line_profit' 
                                    && results[item_row]['item_price']
                                    && results[item_row]['item_cost']
                                    && results[item_row]['item_quantity']
                                    )
                                        {

                                            line_profit = (results[item_row]['item_price'] - results[item_row]['item_cost'])
                                            * results[item_row]['item_quantity'];
                                            this.innerHTML = "£" + (Math.round(line_profit * 100) / 100).toFixed(2);
                                        }       

                        }); //span loop 
                        item_row+=1;
                    }); //end ui-sortable-handle loop funct
                

                //Starting the total results
                subtotal = 0;
                total = 0;
                tax = 0;
                total_cost = 0;
                profit = 0;
                protif_p = 0;
                calc = 1;

                for (i=3; i<item_row; i++)
                    {
                        //alert("Row # - " + (parseInt(i)-2) + " Quantity - " + results[i]['item_quantity'] + " Price - " +
                        //results[i]['item_price'] + " Item Cost - " + results[i]['item_cost'] );
                        if (!results[i]['item_quantity'] ||  !results[i]['item_price'] || !results[i]['item_cost'])
                        calc = false;
                    }

                if (calc)
                    {
                        
                        for (i=3; i<item_row; i++)
                            {
                                subtotal = subtotal + results[i]['item_quantity'] * results[i]['item_price'];
                                tax = tax + (results[i]['item_quantity'] * results[i]['item_price'])/5;
                                total_cost = total_cost + parseFloat(results[i]['item_cost'])*parseFloat(results[i]['item_quantity']);
                                //profit = profit + (results[i]['item_price'] - results[i]['item_cost']);
                                total = subtotal + tax;
                            }

                        //$('.table-condensed').css('background','yellow'); 
                        
                        $('.table-condensed.text-right td').each(function()
                                {
                                    if (this.innerHTML == "Nett Total") 
                                            this.nextElementSibling.innerHTML = "£" + (Math.round(subtotal * 100) / 100).toFixed(2);
                                    if (this.innerHTML == "VAT")
                                            this.nextElementSibling.innerHTML = "£" + (Math.round(tax * 100) / 100).toFixed(2);
                                    if (this.innerHTML == "<b>GROSS</b>")
                                            this.nextElementSibling.innerHTML = "£" + (Math.round(total * 100) / 100).toFixed(2);   
                                    if (this.innerHTML == "Total Cost Price") 
                                            this.nextElementSibling.innerHTML = "£" + (Math.round(total_cost * 100) / 100).toFixed(2);
                                    if (this.innerHTML == "Nett Profit") 
                                            {
                                                profit = subtotal - total_cost;
                                                this.nextElementSibling.innerHTML = "£" + (Math.round(profit * 100) / 100).toFixed(2);  

                                            }
                                    if (this.innerHTML == "Profit %") 
                                        {
                                            //profit_p = (profit/subtotal)*100;
                                            this.nextElementSibling.innerHTML  = (Math.round(100 * profit / total_cost 
                                                * 100) / 100).toFixed(2) + " %";    
                                        }

                                });
            
                    } //end calc + modify

                //end of total results

            });//end of function calc :j





            });
        });

        // Toggle checkbox when click on row
        $('#products_table tr').click(function (event) {
            if (event.target.type !== 'checkbox') {
                $(':checkbox', this).trigger('click');
            }
        });

        // Filter on search button click
        $('#filter-button').click(function () {
            products_filter();
        });

        // Filter on family dropdown change
        $("#filter_family").change(function () {
            products_filter();
        });

        // Filter products
        function products_filter() {
            var filter_family = $('#filter_family').val();
            var filter_product = $('#filter_product').val();
            var lookup_url = "<?php echo site_url('products/ajax/modal_product_lookups'); ?>/";
            lookup_url += Math.floor(Math.random() * 1000) + '/?';

            if (filter_family) {
                lookup_url += "&filter_family=" + filter_family;
            }

            if (filter_product) {
                lookup_url += "&filter_product=" + filter_product;
            }

            // refresh modal
            $('#modal-choose-items').modal('hide');
            $('#modal-placeholder').load(lookup_url);
        }
    });
</script>

<div id="modal-choose-items" class="modal col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2"
     role="dialog" aria-labelledby="modal-choose-items" aria-hidden="true">
    <form class="modal-content">
        <div class="modal-header">
            <a data-dismiss="modal" class="close"><i class="fa fa-close"></i></a>

            <h3><?php echo lang('add_product'); ?></h3>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-8">
                    <div class="form-inline">
                        <div class="form-group filter-form">
                            
					<select name="filter_family" id="filter_family" class="form-control">
						<option value=""><?php echo lang('any_family'); ?></option>
						<?php foreach ($families as $family) { ?>
						<option value="<?php echo $family->family_id; ?>"
							<?php if (isset($filter_family) && $family->family_id == $filter_family) {
                                echo ' selected="selected"';
                            } ?>><?php echo $family->family_name; ?></option>
						<?php } ?>
					</select>
					
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="filter_product" id="filter_product"
                                   placeholder="<?php echo lang('product_name'); ?>"
                                   value="<?php echo $filter_product ?>">
                        </div>
                        <button type="button" id="filter-button"
                                class="btn btn-default"><?php echo lang('search_product'); ?></button>
                        <!-- ToDo
                        <button type="button" id="reset-button" class="btn btn-default">
                            <?php //echo lang('reset'); ?>
                        </button>
                        -->
                    </div>
                </div>
                <div class="col-xs-4 text-right">
                    <div class="btn-group">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            <?php echo lang('cancel'); ?>
                        </button>
                        <button class="select-items-confirm btn btn-success" type="button">
                            <i class="fa fa-check"></i>
                            <?php echo lang('submit'); ?>
                        </button>
                    </div>
                </div>
            </div>
            <br/>

            <div class="table-responsive">
                <table id="products_table" class="table table-bordered table-striped">
                    <tr>
                        <th>&nbsp;</th>
                        <th><?php echo lang('product_sku'); ?></th>
                        <th><?php echo lang('family_name'); ?></th>
                        <th><?php echo lang('product_name'); ?></th>
                        <th><?php echo lang('product_description'); ?></th>
                        <th class="text-right"><?php echo lang('product_price'); ?></th>
                    </tr>
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <td class="text-left">
                                <input type="checkbox" name="product_ids[]"
                                       value="<?php echo $product->product_id; ?>">
                            </td>
                            <td nowrap class="text-left">
                                <b><?php echo $product->product_sku; ?></b>
                            </td>
                            <td>
                                <b><?php echo $product->family_name; ?></b>
                            </td>
                            <td>
                                <b><?php echo $product->product_name; ?></b>
                            </td>
                            <td>
                                <?php echo nl2br($product->product_description); ?>
                            </td>
                            <td class="text-right">
                                <?php echo format_currency($product->product_price); ?>
                            </td>
                        </tr>
                        <!-- Todo
						<tr class="bold-border">
                            <td colspan="3">
                                <?php echo $product->product_description; ?>
                            </td>
                        </tr>
						-->
                    <?php } ?>
                </table>
            </div>
        </div>

        <div class="modal-footer">
            <div class="btn-group">
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    <?php echo lang('cancel'); ?>
                </button>
                <button class="select-items-confirm btn btn-success" type="button">
                    <i class="fa fa-check"></i>
                    <?php echo lang('submit'); ?>
                </button>
            </div>
        </div>

    </form>

</div>