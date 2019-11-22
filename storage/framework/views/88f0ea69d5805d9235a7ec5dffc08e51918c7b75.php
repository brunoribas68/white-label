<country-state></country-state>

<?php $__env->startPush('scripts'); ?>

    <script type="text/x-template" id="country-state-template">
        <div>
            <div class="control-group" :class="[errors.has('country') ? 'has-error' : '']">
                <label for="country" class="required">
                    <?php echo e(__('admin::app.customers.customers.country')); ?>

                </label>

                <select type="text" v-validate="'required'" class="control" id="country" name="country" v-model="country" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.country')); ?>&quot;">
                    <option value=""></option>

                    <?php $__currentLoopData = core()->countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($country->code); ?>"><?php echo e($country->name); ?></option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <span class="control-error" v-if="errors.has('country')">
                    {{ errors.first('country') }}
                </span>
            </div>

            <div class="control-group" :class="[errors.has('state') ? 'has-error' : '']">
                <label for="state" class="required">
                    <?php echo e(__('admin::app.customers.customers.state')); ?>

                </label>

                <input type="text" v-validate="'required'" class="control" id="state" name="state" v-model="state" v-if="!haveStates()" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.state')); ?>&quot;"/>

                <select v-validate="'required'" class="control" id="state" name="state" v-model="state" v-if="haveStates()" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.state')); ?>&quot;">

                    <option value=""><?php echo e(__('admin::app.customers.customers.select-state')); ?></option>

                    <option v-for='(state, index) in countryStates[country]' :value="state.code">
                        {{ state.default_name }}
                    </option>

                </select>

                <span class="control-error" v-if="errors.has('state')">
                    {{ errors.first('state') }}
                </span>
            </div>
        </div>
    </script>

    <script>
        Vue.component('country-state', {

            template: '#country-state-template',

            inject: ['$validator'],

            data: function () {
                return {
                    country: "<?php echo e($countryCode); ?>",

                    state: "<?php echo e($stateCode); ?>",

                    countryStates: <?php echo json_encode(core()->groupedStatesByCountries(), 15, 512) ?>
                }
            },

            methods: {
                haveStates: function () {
                    if (this.countryStates[this.country] && this.countryStates[this.country].length)
                        return true;

                    return false;
                },
            }
        });
    </script>
<?php $__env->stopPush(); ?>