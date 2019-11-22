<?php
    $validations = [];
    $disabled = false;

    if (isset($field['validation'])) {
        array_push($validations, $field['validation']);
    }

    $validations = implode('|', array_filter($validations));

    $key = $item['key'];
    $key = explode(".", $key);
    $firstField = current($key);
    $secondField = next($key);
    $thirdField  = end($key);

    $name = $item['key'] . '.' . $field['name'];

    if (isset($field['repository'])) {
        $temp = explode("@", $field['repository']);
        $class = app(current($temp));
        $method = end($temp);
        $value = $class->$method();
    }

    $channel_locale = [];

    if (isset($field['channel_based']) && $field['channel_based'])
    {
        array_push($channel_locale, $channel);
    }

    if (isset($field['locale_based']) && $field['locale_based']) {
        array_push($channel_locale, $locale);
    }
?>

    <?php if($field['type'] == 'depends'): ?>

        <?php

            $depends = explode(":", $field['depend']);
            $dependField = current($depends);
            $dependValue = end($depends);

            if (count($channel_locale)) {
                $channel_locale = implode(' - ', $channel_locale);
            } else {
                $channel_locale = '';
            }

            if (isset($value) && $value) {
                $i = 0;
                foreach ($value as $key => $result) {
                    $data['title'] = $result;
                    $data['value'] = $key;
                    $options[$i] = $data;
                    $i++;
                }
                $field['options'] = $options;
            }

            if (! isset($field['options'])) {
                $field['options'] = '';
            }

            $selectedOption = core()->getConfigData($name) ?? '';
        ?>

        <depends
            :options = '<?php echo json_encode($field['options'], 15, 512) ?>'
            :name = "'<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]'"
            :validations = "'<?php echo e($validations); ?>'"
            :depend = "'<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($dependField); ?>]'"
            :value = "'<?php echo e($dependValue); ?>'"
            :field_name = "'<?php echo e(trans($field['title'])); ?>'"
            :channel_locale = "'<?php echo e($channel_locale); ?>'"
            :result = "'<?php echo e($selectedOption); ?>'"
        ></depends>

    <?php else: ?>

        <div class="control-group <?php echo e($field['type']); ?>" <?php if($field['type'] == 'multiselect'): ?> :class="[errors.has('<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>][]') ? 'has-error' : '']" <?php else: ?> :class="[errors.has('<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]') ? 'has-error' : '']" <?php endif; ?>>

            <label for="<?php echo e($name); ?>" <?php echo e(!isset($field['validation']) || preg_match('/\brequired\b/', $field['validation']) == false ? '' : 'class=required'); ?>>

                <?php echo e(trans($field['title'])); ?>


                <?php if(count($channel_locale)): ?>
                    <span class="locale">[<?php echo e(implode(' - ', $channel_locale)); ?>]</span>
                <?php endif; ?>

            </label>

            <?php if($field['type'] == 'text'): ?>

                <input type="text" v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" value="<?php echo e(old($name) ?: core()->getConfigData($name)); ?>" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;">

            <?php elseif($field['type'] == 'password'): ?>

                <input type="password" v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" value="<?php echo e(old($name) ?: core()->getConfigData($name)); ?>" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;">

            <?php elseif($field['type'] == 'color'): ?>

                <input type="color" v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" value="<?php echo e(old($name) ?: core()->getConfigData($name)); ?>" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;">


            <?php elseif($field['type'] == 'textarea'): ?>

                <textarea v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;"><?php echo e(old($name) ?: core()->getConfigData($name)); ?></textarea>

            <?php elseif($field['type'] == 'select'): ?>

                <select v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;" >

                    <?php
                        $selectedOption = core()->getConfigData($name) ?? '';
                    ?>

                    <?php if(isset($field['repository'])): ?>
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($key); ?>" <?php echo e($key == $selectedOption ? 'selected' : ''); ?>>
                            <?php echo e(trans($option)); ?>

                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if (! isset($option['value'])) {
                                    $value = null;
                                } else {
                                    $value = $option['value'];

                                    if (! $value) {
                                        $value = 0;
                                    }
                                }
                            ?>

                            <option value="<?php echo e($value); ?>" <?php echo e($value == $selectedOption ? 'selected' : ''); ?>>
                                <?php echo e(trans($option['title'])); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </select>

            <?php elseif($field['type'] == 'multiselect'): ?>

                <select v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>][]" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;"  multiple>

                    <?php
                        $selectedOption = core()->getConfigData($name) ?? '';
                    ?>

                    <?php if(isset($field['repository'])): ?>
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <option value="<?php echo e($key); ?>" <?php echo e(in_array($key, explode(',', $selectedOption)) ? 'selected' : ''); ?>>
                                <?php echo e(trans($value[$key])); ?>

                            </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if (! isset($option['value'])) {
                                    $value = null;
                                } else {
                                    $value = $option['value'];

                                    if (! $value) {
                                        $value = 0;
                                    }
                                }
                            ?>

                            <option value="<?php echo e($value); ?>" <?php echo e(in_array($option['value'], explode(',', $selectedOption)) ? 'selected' : ''); ?>>
                                <?php echo e($option['title']); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </select>

            <?php elseif($field['type'] == 'country'): ?>

                <?php
                    $countryCode = core()->getConfigData($name) ?? '';
                ?>

                <country
                    :country_code = "'<?php echo e($countryCode); ?>'"
                    :validations = "'<?php echo e($validations); ?>'"
                    :name = "'<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]'"
                ></country>

            <?php elseif($field['type'] == 'state'): ?>

                <?php
                    $stateCode = core()->getConfigData($name) ?? '';
                ?>

                <state
                    :state_code = "'<?php echo e($stateCode); ?>'"
                    :validations = "'<?php echo e($validations); ?>'"
                    :name = "'<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]'"
                ></state>

            <?php elseif($field['type'] == 'boolean'): ?>

                <select v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;">

                    <?php
                        $selectedOption = core()->getConfigData($name) ?? '';
                    ?>

                    <option value="0" <?php echo e($selectedOption ? '' : 'selected'); ?>>
                        <?php echo e(__('admin::app.configuration.no')); ?>

                    </option>

                    <option value="1" <?php echo e($selectedOption ? 'selected' : ''); ?>>
                        <?php echo e(__('admin::app.configuration.yes')); ?>

                    </option>

                </select>

            <?php elseif($field['type'] == 'image'): ?>

                <?php
                    $src = Storage::url(core()->getConfigData($name));
                    $result = core()->getConfigData($name);
                ?>

                <?php if($result): ?>
                    <a href="<?php echo e($src); ?>" target="_blank">
                        <img src="<?php echo e($src); ?>" class="configuration-image"/>
                    </a>
                <?php endif; ?>

                <input type="file" v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" value="<?php echo e(old($name) ?: core()->getConfigData($name)); ?>" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;" style="padding-top: 5px;">

                <?php if($result): ?>
                    <div class="control-group" style="margin-top: 5px;">
                        <span class="checkbox">
                            <input type="checkbox" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>][delete]"  name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>][delete]" value="1">

                            <label class="checkbox-view" for="delete"></label>
                                <?php echo e(__('admin::app.configuration.delete')); ?>

                        </span>
                    </div>
                <?php endif; ?>

            <?php elseif($field['type'] == 'file'): ?>

                <?php
                    $result = core()->getConfigData($name);
                    $src = explode("/", $result);
                    $path = end($src);
                ?>

                <?php if($result): ?>
                    <a href="<?php echo e(route('admin.configuration.download', [request()->route('slug'), request()->route('slug2'), $path])); ?>">
                        <i class="icon sort-down-icon download"></i>
                    </a>
                <?php endif; ?>

                <input type="file" v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]" value="<?php echo e(old($name) ?: core()->getConfigData($name)); ?>" data-vv-as="&quot;<?php echo e(trans($field['title'])); ?>&quot;" style="padding-top: 5px;">

                <?php if($result): ?>
                    <div class="control-group" style="margin-top: 5px;">
                        <span class="checkbox">
                            <input type="checkbox" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>][delete]"  name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>][delete]" value="1">

                            <label class="checkbox-view" for="delete"></label>
                                <?php echo e(__('admin::app.configuration.delete')); ?>

                        </span>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

            <?php if(isset($field['info'])): ?>
                <span class="control-info mt-10"><?php echo e(trans($field['info'])); ?></span>
            <?php endif; ?>

            <span class="control-error" <?php if($field['type'] == 'multiselect'): ?>  v-if="errors.has('<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>][]')" <?php else: ?>  v-if="errors.has('<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($thirdField); ?>][<?php echo e($field['name']); ?>]')" <?php endif; ?>
            >
            <?php if($field['type'] == 'multiselect'): ?>
                {{ errors.first('<?php echo $firstField; ?>[<?php echo $secondField; ?>][<?php echo $thirdField; ?>][<?php echo $field['name']; ?>][]') }}
            <?php else: ?>
                {{ errors.first('<?php echo $firstField; ?>[<?php echo $secondField; ?>][<?php echo $thirdField; ?>][<?php echo $field['name']; ?>]') }}
            <?php endif; ?>
            </span>

        </div>

    <?php endif; ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/x-template" id="country-template">

    <div>
        <select type="text" v-validate="validations" class="control" :id="name" :name="name" v-model="country" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.country')); ?>&quot;" @change="sendCountryCode">
            <option value=""></option>

            <?php $__currentLoopData = core()->countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($country->code); ?>"><?php echo e($country->name); ?></option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

</script>

<script>
    Vue.component('country', {

        template: '#country-template',

        inject: ['$validator'],

        props: ['country_code', 'name', 'validations'],

        data: function () {
            return {
                country: "",
            }
        },

        mounted: function () {
            this.country = this.country_code;
            this.sendCountryCode()
        },

        methods: {
            sendCountryCode: function () {
                this.$root.$emit('countryCode', this.country)
            },
        }
    });
</script>

<script type="text/x-template" id="state-template">

    <div>
        <input type="text" v-validate="'required'" v-if="!haveStates()" class="control" v-model="state" :id="name" :name="name" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.state')); ?>&quot;"/>

        <select v-validate="'required'" v-if="haveStates()" class="control" v-model="state" :id="name" :name="name" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.state')); ?>&quot;" >

            <option value=""><?php echo e(__('admin::app.customers.customers.select-state')); ?></option>

            <option v-for='(state, index) in countryStates[country]' :value="state.code">
                {{ state.default_name }}
            </option>

        </select>

    </div>

</script>

<script>
    Vue.component('state', {

        template: '#state-template',

        inject: ['$validator'],

        props: ['state_code', 'name', 'validations'],

        data: function () {
            return {
                state: "",

                country: "",

                countryStates: <?php echo json_encode(core()->groupedStatesByCountries(), 15, 512) ?>
            }
        },

        mounted: function () {
            this.state = this.state_code
        },

        methods: {
            haveStates: function () {
                var this_this = this;

                this_this.$root.$on('countryCode', function (country) {
                    this_this.country = country;
                });

                if (this.countryStates[this.country] && this.countryStates[this.country].length)
                    return true;

                return false;
            },
        }
    });
</script>

<script type="text/x-template" id="depends-template">

    <div class="control-group"  :class="[errors.has(name) ? 'has-error' : '']" v-if="this.isVisible">
        <label :for="name" :class="[ isRequire ? 'required' : '']">
            {{ field_name }}
            <span class="locale"> [{{ channel_locale }}] </span>
        </label>

        <select v-if="this.options.length" v-validate= "validations" class="control" :id = "name" :name = "name" v-model="this.result"
        :data-vv-as="field_name">
            <option v-for='(option, index) in this.options' :value="option.value"> {{ option.title }} </option>
        </select>

        <input v-else type="text"  class="control" v-validate= "validations" :id = "name" :name = "name" v-model="this.result"
        :data-vv-as="field_name">

        <span class="control-error" v-if="errors.has(name)">
            {{ errors.first(name) }}
        </span>
    </div>

</script>

<script>
    Vue.component('depends', {

        template: '#depends-template',

        inject: ['$validator'],

        props: ['options', 'name', 'validations', 'depend', 'value', 'field_name', 'channel_locale', 'repository', 'result'],

        data: function() {
            return {
                isRequire: false,
                isVisible: false,
            }
        },

        mounted: function () {
            var this_this = this;

            if (this_this.validations || (this_this.validations.indexOf("required") != -1)) {
                this_this.isRequire = true;
            }

            $(document).ready(function(){
                var dependentElement = document.getElementById(this_this.depend);
                var dependValue = this_this.value;

                if (dependValue == 'true') {
                    dependValue = 1;
                } else if (dependValue == 'false') {
                    dependValue = 0;
                }

                $(document).on("change", "select.control", function() {
                    if (this_this.depend == this.name) {
                        if (this_this.value == this.value) {
                            this_this.isVisible = true;
                        } else {
                            this_this.isVisible = false;
                        }
                    }
                })

                if (dependentElement && dependentElement.value == dependValue) {
                    this_this.isVisible = true;
                } else {
                    this_this.isVisible = false;
                }

                if (this_this.result) {
                    if (dependentElement.value == this_this.value) {
                        this_this.isVisible = true;
                    } else {
                        this_this.isVisible = false;
                    }
                }
            });
        }
    });
</script>

<?php $__env->stopPush(); ?>