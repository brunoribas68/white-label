<form data-vv-scope="address-form">

    <div class="form-container" v-if="!this.new_billing_address">
        <div class="form-header mb-30">
            <span class="checkout-step-heading"><?php echo e(__('shop::app.checkout.onepage.billing-address')); ?></span>

            <a class="btn btn-lg btn-primary" @click  = newBillingAddress()>
                <?php echo e(__('shop::app.checkout.onepage.new-address')); ?>

            </a>
        </div>
        <div class="address-holder">
            <div class="address-card" v-for='(addresses, index) in this.allAddress'>
                <div class="checkout-address-content" style="display: flex; flex-direction: row; justify-content: space-between; width: 100%;">
                    <label class="radio-container" style="float: right; width: 10%;">
                        <input type="radio" v-validate="'required'" id="billing[address_id]" name="billing[address_id]" :value="addresses.id" v-model="address.billing.address_id" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.billing-address')); ?>&quot;">
                        <span class="checkmark"></span>
                    </label>

                    <ul class="address-card-list" style="float: right; width: 85%;">
                        <li class="mb-10">
                            <b>{{ allAddress.first_name }} {{ allAddress.last_name }},</b>
                        </li>

                        <li class="mb-5">
                            {{ addresses.address1 }},
                        </li>

                        <li class="mb-5">
                            {{ addresses.city }},
                        </li>

                        <li class="mb-5">
                            {{ addresses.state }},
                        </li>

                        <li class="mb-15">
                            {{ addresses.country }}.
                        </li>

                        <li>
                            <b><?php echo e(__('shop::app.customer.account.address.index.contact')); ?></b> : {{ addresses.phone }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="control-group" :class="[errors.has('address-form.billing[address_id]') ? 'has-error' : '']">
                <span class="control-error" v-if="errors.has('address-form.billing[address_id]')">
                    {{ errors.first('address-form.billing[address_id]') }}
                </span>
            </div>
        </div>
        <div class="control-group mt-5">
            <span class="checkbox">
                <input type="checkbox" id="billing[use_for_shipping]" name="billing[use_for_shipping]" v-model="address.billing.use_for_shipping"/>
                    <label class="checkbox-view" for="billing[use_for_shipping]"></label>
                    <?php echo e(__('shop::app.checkout.onepage.use_for_shipping')); ?>

            </span>

        </div>
    </div>

    <div class="form-container" v-if="this.new_billing_address">

        <div class="form-header">
            <h1><?php echo e(__('shop::app.checkout.onepage.billing-address')); ?></h1>

            <?php if(auth()->guard('customer')->guest()): ?>
                <a class="btn btn-lg btn-primary" href="<?php echo e(route('customer.session.index')); ?>">
                    <?php echo e(__('shop::app.checkout.onepage.sign-in')); ?>

                </a>
            <?php endif; ?>

            <?php if(auth()->guard('customer')->check()): ?>
                <?php if(count(auth('customer')->user()->addresses)): ?>
                    <a class="btn btn-lg btn-primary" @click  = backToSavedBillingAddress()>
                        <?php echo e(__('shop::app.checkout.onepage.back')); ?>

                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[first_name]') ? 'has-error' : '']">
            <label for="billing[first_name]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.first-name')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="billing[first_name]" name="billing[first_name]" v-model="address.billing.first_name" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.first-name')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.billing[first_name]')">
                {{ errors.first('address-form.billing[first_name]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[last_name]') ? 'has-error' : '']">
            <label for="billing[last_name]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.last-name')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="billing[last_name]" name="billing[last_name]" v-model="address.billing.last_name" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.last-name')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.billing[last_name]')">
                {{ errors.first('address-form.billing[last_name]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[email]') ? 'has-error' : '']">
            <label for="billing[email]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.email')); ?>

            </label>

            <input type="text" v-validate="'required|email'" class="control" id="billing[email]" name="billing[email]" v-model="address.billing.email" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.email')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.billing[email]')">
                {{ errors.first('address-form.billing[email]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[address1][]') ? 'has-error' : '']">
            <label for="billing_address_0" class="required">
                <?php echo e(__('shop::app.checkout.onepage.address1')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="billing_address_0" name="billing[address1][]" v-model="address.billing.address1[0]" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.address1')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.billing[address1][]')">
                {{ errors.first('address-form.billing[address1][]') }}
            </span>
        </div>

        <?php if(core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1): ?>
            <div class="control-group" style="margin-top: -25px;">
                <?php for($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++): ?>
                    <input type="text" class="control" name="billing[address1][<?php echo e($i); ?>]" id="billing_address_<?php echo e($i); ?>" v-model="address.billing.address1[<?php echo e($i); ?>]">
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <div class="control-group" :class="[errors.has('address-form.billing[city]') ? 'has-error' : '']">
            <label for="billing[city]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.city')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="billing[city]" name="billing[city]" v-model="address.billing.city" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.city')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.billing[city]')">
                {{ errors.first('address-form.billing[city]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[state]') ? 'has-error' : '']">
            <label for="billing[state]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.state')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="billing[state]" name="billing[state]" v-model="address.billing.state" v-if="!haveStates('billing')" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;"/>

            <select v-validate="'required'" class="control" id="billing[state]" name="billing[state]" v-model="address.billing.state" v-if="haveStates('billing')" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;">

                <option value=""><?php echo e(__('shop::app.checkout.onepage.select-state')); ?></option>

                <option v-for='(state, index) in countryStates[address.billing.country]' :value="state.code">
                    {{ state.default_name }}
                </option>

            </select>

            <span class="control-error" v-if="errors.has('address-form.billing[state]')">
                {{ errors.first('address-form.billing[state]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[postcode]') ? 'has-error' : '']">
            <label for="billing[postcode]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.postcode')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="billing[postcode]" name="billing[postcode]" v-model="address.billing.postcode" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.postcode')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.billing[postcode]')">
                {{ errors.first('address-form.billing[postcode]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[country]') ? 'has-error' : '']">
            <label for="billing[country]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.country')); ?>

            </label>

            <select type="text" v-validate="'required'" class="control" id="billing[country]" name="billing[country]" v-model="address.billing.country" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.country')); ?>&quot;">
                <option value=""></option>

                <?php $__currentLoopData = core()->countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($country->code); ?>"><?php echo e($country->name); ?></option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <span class="control-error" v-if="errors.has('address-form.billing[country]')">
                {{ errors.first('address-form.billing[country]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.billing[phone]') ? 'has-error' : '']">
            <label for="billing[phone]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.phone')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="billing[phone]" name="billing[phone]" v-model="address.billing.phone" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.phone')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.billing[phone]')">
                {{ errors.first('address-form.billing[phone]') }}
            </span>
        </div>

        <div class="control-group">
            <span class="checkbox">
                <input type="checkbox" id="billing[use_for_shipping]" name="billing[use_for_shipping]" v-model="address.billing.use_for_shipping"/>
                <label class="checkbox-view" for="billing[use_for_shipping]"></label>
                <?php echo e(__('shop::app.checkout.onepage.use_for_shipping')); ?>

            </span>

        </div>

        <?php if(auth()->guard('customer')->check()): ?>
            <div class="control-group">
                <span class="checkbox">
                    <input type="checkbox" id="billing[save_as_address]" name="billing[save_as_address]" v-model="address.billing.save_as_address"/>
                    <label class="checkbox-view" for="billing[save_as_address]"></label>
                    <?php echo e(__('shop::app.checkout.onepage.save_as_address')); ?>

                </span>
            </div>
        <?php endif; ?>

    </div>

    <div class="form-container" v-if="!address.billing.use_for_shipping && !this.new_shipping_address">
        <div class="form-header mb-30">
            <span class="checkout-step-heading"><?php echo e(__('shop::app.checkout.onepage.shipping-address')); ?></span>

            <a class="btn btn-lg btn-primary" @click=newShippingAddress()>
                <?php echo e(__('shop::app.checkout.onepage.new-address')); ?>

            </a>
        </div>

        <div class="address-holder">
            <div class="address-card" v-for='(addresses, index) in this.allAddress'>
                <div class="checkout-address-content" style="display: flex; flex-direction: row; justify-content: space-between; width: 100%;">
                    <label class="radio-container" style="float: right; width: 10%;">
                        <input v-validate="'required'" type="radio" id="shipping[address_id]" name="shipping[address_id]" v-model="address.shipping.address_id" :value="addresses.id"
                        data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.shipping-address')); ?>&quot;">
                        <span class="checkmark"></span>
                    </label>

                    <ul class="address-card-list" style="float: right; width: 85%;">
                        <li class="mb-10">
                            <b>{{ allAddress.first_name }} {{ allAddress.last_name }},</b>
                        </li>

                        <li class="mb-5">
                            {{ addresses.address1 }},
                        </li>

                        <li class="mb-5">
                            {{ addresses.city }},
                        </li>

                        <li class="mb-5">
                            {{ addresses.state }},
                        </li>

                        <li class="mb-15">
                            {{ addresses.country }}.
                        </li>

                        <li>
                            <b><?php echo e(__('shop::app.customer.account.address.index.contact')); ?></b> : {{ addresses.phone }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="control-group" :class="[errors.has('address-form.shipping[address_id]') ? 'has-error' : '']">
                <span class="control-error" v-if="errors.has('address-form.shipping[address_id]')">
                    {{ errors.first('address-form.shipping[address_id]') }}
                </span>
            </div>

        </div>
    </div>

    <div class="form-container" v-if="!address.billing.use_for_shipping && this.new_shipping_address">

        <div class="form-header">
            <h1><?php echo e(__('shop::app.checkout.onepage.shipping-address')); ?></h1>

            <?php if(auth()->guard('customer')->check()): ?>
                <?php if(count(auth('customer')->user()->addresses)): ?>
                    <a class="btn btn-lg btn-primary" @click  = backToSavedShippingAddress()>
                        <?php echo e(__('shop::app.checkout.onepage.back')); ?>

                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[first_name]') ? 'has-error' : '']">
            <label for="shipping[first_name]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.first-name')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="shipping[first_name]" name="shipping[first_name]" v-model="address.shipping.first_name" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.first-name')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.shipping[first_name]')">
                {{ errors.first('address-form.shipping[first_name]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[last_name]') ? 'has-error' : '']">
            <label for="shipping[last_name]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.last-name')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="shipping[last_name]" name="shipping[last_name]" v-model="address.shipping.last_name" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.last-name')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.shipping[last_name]')">
                {{ errors.first('address-form.shipping[last_name]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[email]') ? 'has-error' : '']">
            <label for="shipping[email]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.email')); ?>

            </label>

            <input type="text" v-validate="'required|email'" class="control" id="shipping[email]" name="shipping[email]" v-model="address.shipping.email" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.email')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.shipping[email]')">
                {{ errors.first('address-form.shipping[email]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[address1][]') ? 'has-error' : '']">
            <label for="shipping_address_0" class="required">
                <?php echo e(__('shop::app.checkout.onepage.address1')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="shipping_address_0" name="shipping[address1][]" v-model="address.shipping.address1[0]" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.address1')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.shipping[address1][]')">
                {{ errors.first('address-form.shipping[address1][]') }}
            </span>
        </div>

        <?php if(core()->getConfigData('customer.settings.address.street_lines') && core()->getConfigData('customer.settings.address.street_lines') > 1): ?>
            <div class="control-group" style="margin-top: -25px;">
                <?php for($i = 1; $i < core()->getConfigData('customer.settings.address.street_lines'); $i++): ?>
                    <input type="text" class="control" name="shipping[address1][<?php echo e($i); ?>]" id="shipping_address_<?php echo e($i); ?>" v-model="address.shipping.address1[<?php echo e($i); ?>]">
                <?php endfor; ?>
            </div>
        <?php endif; ?>

        <div class="control-group" :class="[errors.has('address-form.shipping[city]') ? 'has-error' : '']">
            <label for="shipping[city]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.city')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="shipping[city]" name="shipping[city]" v-model="address.shipping.city" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.city')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.shipping[city]')">
                {{ errors.first('address-form.shipping[city]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[state]') ? 'has-error' : '']">
            <label for="shipping[state]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.state')); ?>

            </label>


            <input type="text" v-validate="'required'" class="control" id="shipping[state]" name="shipping[state]" v-model="address.shipping.state" v-if="!haveStates('shipping')" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;"/>

            <select v-validate="'required'" class="control" id="shipping[state]" name="shipping[state]" v-model="address.shipping.state" v-if="haveStates('shipping')" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.state')); ?>&quot;">

                <option value=""><?php echo e(__('shop::app.checkout.onepage.select-state')); ?></option>

                <option v-for='(state, index) in countryStates[address.shipping.country]' :value="state.code">
                    {{ state.default_name }}
                </option>

            </select>

            <span class="control-error" v-if="errors.has('address-form.shipping[state]')">
                {{ errors.first('address-form.shipping[state]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[postcode]') ? 'has-error' : '']">
            <label for="shipping[postcode]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.postcode')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="shipping[postcode]" name="shipping[postcode]" v-model="address.shipping.postcode" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.postcode')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.shipping[postcode]')">
                {{ errors.first('address-form.shipping[postcode]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[country]') ? 'has-error' : '']">
            <label for="shipping[country]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.country')); ?>

            </label>

            <select type="text" v-validate="'required'" class="control" id="shipping[country]" name="shipping[country]" v-model="address.shipping.country" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.country')); ?>&quot;">
                <option value=""></option>

                <?php $__currentLoopData = core()->countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($country->code); ?>"><?php echo e($country->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <span class="control-error" v-if="errors.has('address-form.shipping[country]')">
                {{ errors.first('address-form.shipping[country]') }}
            </span>
        </div>

        <div class="control-group" :class="[errors.has('address-form.shipping[phone]') ? 'has-error' : '']">
            <label for="shipping[phone]" class="required">
                <?php echo e(__('shop::app.checkout.onepage.phone')); ?>

            </label>

            <input type="text" v-validate="'required'" class="control" id="shipping[phone]" name="shipping[phone]" v-model="address.shipping.phone" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.phone')); ?>&quot;"/>

            <span class="control-error" v-if="errors.has('address-form.shipping[phone]')">
                {{ errors.first('address-form.shipping[phone]') }}
            </span>
        </div>

        <?php if(auth()->guard('customer')->check()): ?>
            <div class="control-group">
                <span class="checkbox">
                    <input type="checkbox" id="shipping[save_as_address]" name="shipping[save_as_address]" v-model="address.shipping.save_as_address"/>
                    <label class="checkbox-view" for="shipping[save_as_address]"></label>
                    <?php echo e(__('shop::app.checkout.onepage.save_as_address')); ?>

                </span>
            </div>
        <?php endif; ?>

    </div>

</form>
