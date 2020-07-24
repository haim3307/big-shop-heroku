<template>
    <form :action="url+'/checkout'" method="POST" id="payment-form" @submit.prevent="pay()">
        <input :value="orderId" name="order_id" type="hidden">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input :value="email" class="form-control" id="email" type="email">
        </div>

        <div class="form-group">
            <label for="name_on_card">Name on Card</label>
            <input class="form-control" id="name_on_card" name="name_on_card" type="text" v-model="name_on_card">
        </div>

        <div class="g-row" style="grid-gap: 15px;">
            <div class="g-col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input :value="info.address" class="form-control" id="address" name="address" type="text">
                </div>
            </div>

            <div class="g-col-md-3">
                <div class="form-group">
                    <label for="city">City</label>
                    <input :value="info.city" class="form-control" id="city" name="city" type="text">
                </div>
            </div>

            <div class="g-col-md-3">
                <div class="form-group">
                    <label for="province">Province</label>
                    <input :value="info.province" class="form-control" id="province" name="province" type="text">
                </div>
            </div>
            <div class="g-col-md-4">
                <div class="form-group">
                    <label for="postalcode">Postal Code</label>
                    <input :value="info.postal_code" class="form-control" id="postalcode" name="postalcode" type="text">
                </div>
            </div>

            <div class="g-col-md-4">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input :value="info.country" class="form-control" id="country" name="country" type="text">
                </div>
            </div>

            <div class="g-col-md-4">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input :value="info.phone" class="form-control" id="phone" name="phone" type="text">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="card-element">Credit Card</label>
            <card-element></card-element>
        </div>

        <!-- CSRF Field -->
        <input :value="csrf" name="_token" type="hidden">

        <div class="spacer"></div>

        <button class="btn btn-success" type="submit">Submit Payment</button>
    </form>
</template>

<script>
    import {createToken} from 'vue-stripe-elements-plus';

    export default {
        props: ['orderId', 'info', 'email'],
        data() {
            return {
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                name_on_card: '',
            }
        },
        methods: {
            pay() {
                // createToken returns a Promise which resolves in a result object with
                // either a token or an error key.
                // See https://stripe.com/docs/api#tokens for the token object.
                // See https://stripe.com/docs/api#errors for the error object.
                // More general https://stripe.com/docs/stripe.js#stripe-create-token.
                var options = {
                    name: this.name_on_card,
                };
                createToken(options).then(result => {
                    // var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);

                    this.$el.appendChild(hiddenInput);

                    // Submit the form
                    this.$el.submit();
                })
            }
        }
    }
</script>
