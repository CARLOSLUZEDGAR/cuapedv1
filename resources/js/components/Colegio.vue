<template>
  <div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">            
            <h1>
              <i class="far fa-bookmark"></i>
              SISCUAPED
              <small>1.0.0</small>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modals & Alerts</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-globe-americas"></i>
                  COLEGIOS
                </h3>
              </div>
              <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                            <!-- select combo patr abuscar-->
                                <select class="form-control col-md-4" v-model="criterio">
                                    <!-- values como la base de datos -->
                                    <option value="col_nombre">NOMBRE</option>
                                    <option value="col_sie">SIE</option>
                                    <!--<option value="per_paterno">APELLIDO PATERNO</option>-->
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarColegios(1,buscar,criterio)" class="form-control" placeholder="TEXTO A BUSCAR">
                                <button type="submit" @click="listarColegios(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> BUSCAR</button><br>
                            </div><br>
                            <div class="form-group row">
                                <button type="button" class="btn btn-primary btn-sm" @click="NuevoColegio()">
                                    <i class="far fa-file-alt" aria-hidden="true">  REGISTRAR COLEGIO</i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-primary btn-sm" @click="generarReporte(per_codigo)">
                                    <i class="far fa-file-alt" aria-hidden="true">  GENERAR REPORTE</i>
                                </button> &nbsp;
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th><center>OPCIONES</center></th>
                                <th><center>SIE</center></th>
                                <th><center>COLEGIO</center></th>
                                <th><center>OPCIONES</center></th>
                                <!--<th><center>AP. MATERNO</center></th>
                                <th><center>NOMBRES</center></th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="colegio in arrayColegio" :key="colegio.id">
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" @click="abrirEditar(colegio)">
                                        <i class="fas fa-edit"></i>
                                    </button> &nbsp;
                                    <template v-if="colegio.col_estado==1">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(usuario.id)" >
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    </template>
                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(usuario.id)">
                                        <i class="far fa-check-square"></i>
                                    </button>
                                    </template>
                                </td>
                                <td v-text="colegio.col_sie" ></td>
                                
                                <td v-text="colegio.col_abreviatura" ></td>
                                <td style="width:100px; text-align:center">
                                  <button type="button" class="btn btn-success btn-sm" @click="EnvioDatos(colegio.id)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                  </button> &nbsp;
                                </td>
                                <!--<td>{{personal.gra_abreviatura}}{{personal.estu_abreviatura}}</td>
                                <td v-text="personal.per_paterno"></td>
                                <td v-text="personal.per_materno"></td>
                                <td v-text="personal.per_nombre"></td>-->
                                <!--<td>
                                <div v-if="usuario.estado">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Inactivo</span>
                                </div>
                                </td>-->
                            </tr>
                            
                        </tbody>
                    </table><br>
                    <nav>
                        <!-- inicio para paginacion -->
                       <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                           
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                        <!-- fin paginacion -->
                    </nav>
                </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div>
      <!-- /.container-fluid -->
      <!--MODAL CLASES
        id="NombreModal" -->
        <div class="modal fade" id="NuevoColegio">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">REGISTRAR COLEGIO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="celular">FOTO</label>
                            <input type="file" class="form-control" @change="obtenerImagen" accept="image/*">
                            <!-- <input type="file" class="form-control" @change="obtenerImagen" accept="image/*" :class="hasError('foto') ? 'is-invalid' : ''">
                            <div v-if="hasError('foto')" class="invalid-feedback">
                                <div class="error" v-if="!$v.formData.foto.required">Ingrese valor porfavor.</div>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <label class="form-control-label" for="text-input">NOMBRE COLEGIO</label>
                            <input type="text" v-model="col_nombre" class="form-control" :class="{ 'is-invalid' : $v.col_nombre.$error, 'is-valid':!$v.col_nombre.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.col_nombre.required">Este campo es Requerido</span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">ABREVIATURA COLEGIO</label>
                            <input type="text" v-model="col_abreviatura" class="form-control" :class="{ 'is-invalid' : $v.col_abreviatura.$error, 'is-valid':!$v.col_abreviatura.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.col_abreviatura.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">SIE COLEGIO</label>
                            <input type="text" v-model="col_sie" class="form-control" :class="{ 'is-invalid' : $v.col_sie.$error, 'is-valid':!$v.col_sie.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.col_sie.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">OBSERVACIONES</label>
                            <textarea name="textarea" class="form-control" rows="3" v-model="col_observaciones"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" @click="Cerrar()">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="RegistrarColegio()">REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal registrar -->
      <div class="modal fade" id="EditarColegio">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDITAR COLEGIO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="Cerrar()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">NOMBRE COLEGIO</label>
                            <input type="text" v-model="col_nombreA" class="form-control" :class="{ 'is-invalid' : $v.col_nombreA.$error, 'is-valid':!$v.col_nombreA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.col_nombreA.required">Este campo es Requerido</span>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">ABREVIATURA COLEGIO</label>
                            <input type="text" v-model="col_abreviaturaA" class="form-control" :class="{ 'is-invalid' : $v.col_abreviaturaA.$error, 'is-valid':!$v.col_abreviaturaA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.col_abreviaturaA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">SIE COLEGIO</label>
                            <input type="text" v-model="col_sieA" class="form-control" :class="{ 'is-invalid' : $v.col_sieA.$error, 'is-valid':!$v.col_sieA.$invalid }">
                            <div class="invalid-feedback">
                                <span v-if="!$v.col_sieA.required">Este campo es Requerido</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="form-control-label" for="text-input">OBSERVACIONES</label>
                            <textarea name="textarea" class="form-control" rows="3" v-model="col_observacionesA"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" @click="Cerrar()">CERRAR</button>
              <button type="button" class="btn btn-primary" @click="EditarColegio()">ACTUALIZAR</button>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      </div>
      <!-- /.modal editar -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import { required, minLength, maxLength, alpha, numeric, email, sameAs} from "vuelidate/lib/validators";
export default {
    data() {
        return {
            
            arrayColegio : [],
            criterio : 'col_nombre',
            buscar : '',

            col_nombre : '',
            col_sie : '',
            col_abreviatura : '',
            col_observaciones : '',
            col_foto : '',

            col_nombreA : '',
            col_sieA : '',
            col_abreviaturaA : '',
            col_observacionesA : '',
            // page : 0,
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
        }
    },

    validations:{
        /*
        nombre_den :{   required,
                        minLength: minLength(3),
                        maxLength: maxLength(14),
                        alpha
                    },
        ap_paterno_den :{   required,
                        minLength: minLength(3),
                        maxLength: maxLength(14),
                        alpha
                    },
        c_identidad_den :{   required,
                        minLength: minLength(5),
                        maxLength: maxLength(9),
                        numeric
                    },
        extencion_den : { required },
        telefono_celular :{   required,
                        minLength: minLength(8),
                        maxLength: maxLength(8),
                        numeric
                    },

        estado_civil : { required },
        fecha_nacimiento : { required },
        id_lugar_trabajo : { required },*/

        col_nombre : { required },
        col_abreviatura : { required },
        col_sie : { required },

        col_nombreA : { required },
        col_abreviaturaA : { required },
        col_sieA : { required },

        validationGroupReg: ['col_nombre', 'col_abreviatura', 'col_sie'],
        validationGroupEdit: ['col_nombreA', 'col_abreviaturaA', 'col_sieA'],
    },

    mounted() {
        this.listarColegios(this.page,this.buscar,this.criterio);
        // this.datosColegio(this.col_id);
    },

    computed:{
        isActived: function(){
            return this.pagination.current_page;
        },

        //Calcuar los elementos de la paginacion
        pagesNumber: function() {
            if(!this.pagination.to){
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset *2);
            if( to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while( from <= to){
                pagesArray.push(from);
                from ++;
            }
            return pagesArray;
        },

        imagen(){
            return this.col_foto;
        }
    },
    methods: {

        Cerrar(){
            this.$v.$reset()
        },

        listarColegios(page,buscar,criterio){
            let me = this;
            axios
            .post("/listarColegio", {
                page : page,
                buscar : buscar,
                criterio : criterio,
                
            })
            .then(function (response) {
                console.log(response)
                me.arrayColegio = response.data.colegio.data
                me.pagination = response.data.pagination;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
        },

        cambiarPagina(page, buscar, criterio){
            let me = this;
            //Actualiza la pagina actual
            me.pagination.current_page= page;
            //Envia la peticion para visualizar  la data de esa pagina
            me.listarColegios(page, buscar, criterio);
        },

        EnvioDatos(datos){
            this.$router.push({
                name: "OpcionColegios",
                //ENVIO DE DATOS
                params:{
                    d: datos
                } 
            });
        },

        obtenerImagen(e){
            try {
                var fileReader = new FileReader();

                fileReader.onload = (e) => {
                    this.col_foto = e.target.result;
                }
                fileReader.readAsDataURL(e.target.files[0])
                this.v = 1;
            } catch (error) {
                
            }
        },

        NuevoColegio(){
            this.$v.$reset(),
            //PONER DE CERO EL MODAL ANTES DE REGISTRAR
            this.col_nombre = '',
            this.col_sie = '',
            this.col_abreviatura = '',
            this.col_observaciones = ''
            //FIN PONER A CERO MODAL
            $('#NuevoColegio').modal('show');
            /*this.obtenerPromocion()
            this.selectDestinos_nivel1()
            this.selectDestinos_nivel2()
            this.selectDestinos_nivel3()
            this.selectDestinos_nivel4()
            this.selectbuscarDestinos_nivel2(this.perdest_destn1_codigo)
            this.selectbuscarDestinos_nivel3(this.perdest_destn2_codigo)
            this.selectbuscarDestinos_nivel4(this.perdest_destn3_codigo)
            this.listarCargos()*/
        },

        RegistrarColegio(){
            this.$v.$reset();
            if(!this.$v.validationGroupReg.$invalid){
                swal.fire({
                    title: 'Esta seguro de registrar este UNIDAD EDUCATIVA', // TITULO 
                    icon: 'question', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#868077', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .post("/registrarColegio", {
                        //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                            col_nombre : me.col_nombre,
                            col_abreviatura : me.col_abreviatura,
                            col_sie : me.col_sie,
                            col_observaciones : me.col_observaciones,
                            col_foto : me.col_foto
                        })
                        .then(function (response) {
                            //Respuesta de la peticion
                            console.log(response);
                            $('#NuevoColegio').modal('hide');
                            me.listarColegios(me.page,me.buscar,me.criterio);
                            this.$v.$reset();
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
                    }
                })  
            }
            else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                //this.$v.$reset();
            }
        },

        abrirEditar(colegio){
            let me =this;
            this.$v.$reset(),
            this.col_id = colegio.id,
            this.col_nombreA = colegio.col_nombre,
            this.col_abreviaturaA = colegio.col_abreviatura,
            this.col_sieA = colegio.col_sie,
            this.col_observacionesA = colegio.col_observacion,
            $('#EditarColegio').modal('show');
        },

        EditarColegio(){
            this.$v.$reset();
            if(!this.$v.validationGroupEdit.$invalid){
                swal.fire({
                    title: 'Esta seguro de modificar esta UNIDAD EDUCATIVA', // TITULO 
                    icon: 'question', //ICONO (success, warnning, error, info, question)
                    showCancelButton: true, //HABILITACION DEL BOTON CANCELAR
                    confirmButtonColor: 'info', // COLOR DEL BOTON PARA CONFIRMAR
                    cancelButtonColor: '#868077', // CLOR DEL BOTON CANCELAR
                    confirmButtonText: 'Confirmar', //TITULO DEL BOTON CONFIRMAR
                    cancelButtonText: 'Cancelar', //TIUTLO DEL BOTON CANCELAR
                    buttonsStyling: true,
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        //CODIGO HA SER VALIDADO
                        let me = this;
                        axios
                        .put("/editarColegio", {
                    //NOMBRE ENVIA AL CONTROLADOR : me.NOMBRE V-MODEL O VARIBLE DECLARADA
                        col_id : me.col_id,
                        col_nombre : me.col_nombreA,
                        col_abreviatura : me.col_abreviaturaA,
                        col_sie : me.col_sieA,
                        col_observaciones : me.col_observacionesA,
                    })
                    .then(function (response) {
                        //Respuesta de la peticion
                        console.log(response);
                        $('#EditarColegio').modal('hide');
                        me.listarColegios(me.page,me.buscar,me.criterio);
                        this.$v.$reset();
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        });
                    }else{
                        console.log('no empezamos');
                    }
                })  
            }else{
                this.$v.$touch();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ingrese todos los datos requeridos',
                    showConfirmButton: false,
                    timer: 2000
                })
                //this.$v.$reset();
            }
        },
    },
};

</script>

<style>
</style>