function starModelsData(){
    var permisos = new _modelPermiso();
        permisos.fetch({
            type: 'POST',
            data: {id_usuario: ''},
            success: function(data){
                _DTTABLELISTAMODULOS.clear().rows.add(data.attributes.data).draw();
            }
        });
}

function fcnCargarDatosDataTables(){
    var modulo = new _modelModuloSistema();
        modulo.fetch({
            type: 'POST',
            success: function(data){
                _DTTABLELISTAMODULOS.clear().rows.add(data.attributes.data).draw();
            }
        });
}

var AdministracionController = Marionette.Object.extend({
                    initialize: function(options){
                        this.NuevoView  = new AppLayoutView();
                        this.collection = new _UsuarioCollection();
                    },

                    mostrarEnConsola : function(){
                        console.log( this.collection );
                    },

                    mostrarCollView : function(){
                        this.NuevoColl.render();
                    }
                });
