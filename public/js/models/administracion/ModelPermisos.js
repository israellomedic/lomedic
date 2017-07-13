var _UsuarioModel =
    Backbone.Model.extend({
                            defaults: {
                            id_usuario      : '',
                            usuario         : '',
                            nombre          : '',
                            paterno         : '',
                            materno         : '',
                            departamento    : '',
                            puesto          : ''
                            },
                            idAttribute : "id_usuario",
                            url         : 'permisos/getdata'
                        });

var _UsuarioCollection =
    Backbone.Collection.extend({
                                model: _UsuarioModel
                               });
