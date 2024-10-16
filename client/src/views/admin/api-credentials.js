define('custom:views/admin/api-credentials', 'views/admin/field-manager', function (Dep) {
    return Dep.extend({
        template: 'custom:api-credentials-settings',
        
        data: function () {
            return {
                apiKey: this.getConfig().get('apiCredentials.apiKey'),
                secretKey: this.getConfig().get('apiCredentials.secretKey'),
                destinationUrl: this.getConfig().get('apiCredentials.destinationUrl')
            };
        },

        setup: function () {
            this.header = 'API Credentials Settings';
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);

            var self = this;

            this.$el.on('click', '#saveApiCredentials', function () {
                var apiKey = self.$el.find('input[name="apiKey"]').val();
                var secretKey = self.$el.find('input[name="secretKey"]').val();
                var destinationUrl = self.$el.find('input[name="destinationUrl"]').val();

                self.getConfig().set('apiCredentials.apiKey', apiKey);
                self.getConfig().set('apiCredentials.secretKey', secretKey);
                self.getConfig().set('apiCredentials.destinationUrl', destinationUrl);
                self.getConfig().save(function () {
                    Espo.Ui.success('Settings saved successfully.');
                });
            });
        }
    });
});
