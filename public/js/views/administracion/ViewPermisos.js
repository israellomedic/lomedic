function cargarCuadrosDeDialogo(){
    jQuery("#dialogBuscarUsuario").dialog({
        autoOpen: false,
        height  : 400,
        width   : 550,
        modal   : true,
        open: function() {
            jQuery("#tdgBuscarUsuario").DataTable({
                "bPaginate": false,
                "bFilter": false,
                "bInfo": false,
                "destroy": true,
                "columns": [
                    { "data": "Usuario" },
                    { "data": "nombre" },
                    { "data": "departamento"},
                    { "data": "puesto"},
                    { "data": "estatus"}
                ]
            });
        },
    });
}

function cargarDataTablePrincipal(){
    var page = $( "#page" );
        var basicControls = [ "#print", "#bold", "#italic", "#undo", "#redo" ];
        var valueControls = [ "#fontsize", "#forecolor", "#hilitecolor", "#backcolor", "fontname" ];

        $( "#print" ).button({
            "icon": "ui-icon-print",
            "showLabel": true
        });

        $( "#redo" ).button({
            "icon": "ui-icon-arrowreturnthick-1-e",
            "showLabel": true
        });

        $( "#undo" ).button({
            "icon": "ui-icon-arrowreturnthick-1-w",
            "showLabel": true
        });

        $( ".toolbar" ).controlgroup();

        _DTTABLELISTAMODULOS  = jQuery('#dtTableListaModulos ').DataTable({
                                "columnDefs": [
                                    { "visible": false, "targets": 0},
                                    { "visible": false, "targets": 1},
                                    { "visible": false, "targets": 3}
                                ],
                                "scrollY": "450",
                                "scrollCollapse": true,
                                "displayLength": 25,
                                "processing": true,
                                "rowCallback" : function(row, data, index){
                                    jQuery(row).attr("title", data.descripcion);
                                },
                                "drawCallback": function(){
                                    var api  = this.api();
                                    var rows = api.rows( {page:'current'} ).nodes();
                                    var last = null;

                                    api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                                            if ( last !== group ) {
                                                $(rows).eq( i ).before(
                                                    '<tr class="group"><td colspan="10">'+group+'</td></tr>'
                                                );
                                                last = group;
                                            }
                                    });
                                },
                                "columns": [
                                    { "data": "id_menu" },
                                    { "data": "modulo" },
                                    { "data": "ruta" },
                                    { "data": "descripcion" },
                                    { "data": "consulta" },
                                    { "data": "agregar" },
                                    { "data": "modificar" },
                                    { "data": "eliminar" },
                                    { "data": "localidad" },
                                    { "data": "cliente" },
                                    { "data": "sucursal" },
                                    { "data": "todas" },
                                    { "data": "privilegio" }
                                ]
                            });
    }

function accFcnBuscarUsuario(){
    _DTTABLELISTAMODULOS.clear().draw();
    jQuery("#dialogBuscarUsuario").dialog("open");
}

var AppLayoutView =
    Marionette.ItemView.extend({
        el: '.toolbar',
        template: false,
        events:{
            'click .evntMostrarPermisos': 'MostrarPermisosGenerales',
            'click .evntBuscarUsuario'  : 'BuscarUsuario'
        },

        MostrarPermisosGenerales: function(){
            fcnCargarDatosDataTables();
        },

        BuscarUsuario : function(){
            accFcnBuscarUsuario();
        },

        initialize : function(){
            cargarCuadrosDeDialogo();
            cargarDataTablePrincipal();
        }
});
