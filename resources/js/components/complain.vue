<template>
    <div class="container">       
        <div class="row justify-content-center">            
            <div class="card" style="width:100%;">
            <div class="card-header">
              <!-- <h3 class="card-title">Diagnose: Patients Symptoms and Complaints</h3> -->
              <h3 class="card-title">Chẩn đoán: các triệu chứng và phản hồi của bệnh nhân</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <!-- <th>Unique ID</th>
                  <th>Name</th>
                  <th>Complain</th>
                  <th>Diagnose</th> -->
                  <th>Mã HSBA</th>
                  <th>Họ tên</th>
                  <th>Phản hồi của bệnh nhân</th>
                  <th>Chẩn đoán</th>
                </tr>
                </thead>
                <tbody>              
                <tr v-for="hospital in hospitals" :key="hospital.id">
                  <td>{{hospital.patient.unique_id}}</td>
                  <td>{{hospital.patient.title}} {{hospital.patient.full_name}}</td>
                  <td>{{hospital.symptoms}}</td>                  
                  <td>
                     <!-- <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + hospital.modal_id">
                        Diagnose
                        </button> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + hospital.modal_id">
                        Chẩn đoán
                        </button>
                      <div class="modal fade" :id="hospital.modal_id" tabindex="-1" role="dialog" aria-labelledby="biodataTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <!-- <h5 class="modal-title" id="exampleModalLongTitle">Diagnose Patient</h5> -->
                              <h5 class="modal-title" id="exampleModalLongTitle">Chẩn đoán bệnh nhân</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form @submit.prevent="addDiagnosis" id="add-diagnosis">                       
                                <!-- <input v-model="form.diagnosis" :value = hospital.patient.unique_id type="hidden" name="patient_id" >   
                                <input  :value = hospital.patient.unique_id type="hidden" name="hospital_id">                                -->
                                            <!-- <input v-model="form.patient_id" 
                                            :value="hospital.patient.id" 
                                            type="radio"
                                            name="patient_id" /> Confirm Action First <br> -->
                                            <input v-model="form.patient_id" 
                                            :value="hospital.patient.id" 
                                            type="radio"
                                            name="patient_id" /> Xác nhận tác vụ trước <br>

                                         <!-- <input v-model="form.hospital_id" 
                                        :value="hospital.id" 
                                        type="radio" 
                                        name="hospital_id" /> Confirm Hospital Details -->
                                        <input v-model="form.hospital_id" 
                                        :value="hospital.id" 
                                        type="radio" 
                                        name="hospital_id" /> Xác nhận thông tin bệnh viện
                                <!-- <input v-model="hospital.patient.id" type="hidden" name="patient_id">                                            
                                <input v-model="hospital.id" type="hidden" name="hospital_id" > -->
                                <!-- <div class="form-group"> 
                                <textarea v-model="form.diagnosis"  placeholder="Diagnosis" name="diagnosis" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('diagnosis') }"></textarea>   -->
                                 <div class="form-group"> 
                                <textarea v-model="form.diagnosis"  placeholder="Chẩn đoán" name="diagnosis" id="" cols="10" rows="5"  class="form-control" :class="{ 'is-invalid': form.errors.has('diagnosis') }"></textarea>                       
                                <has-error :form="form" field="diagnosis"></has-error>                       
                                </div>                                                 
                                <div class="form-group">                        
                                <!-- <input v-model="form.comment" type="text" name="comment" placeholder="Comment"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }">
                                <has-error :form="form" field="comment"></has-error> -->
                                <input v-model="form.comment" type="text" name="comment" placeholder="Nhận xét"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('comment') }">
                                <has-error :form="form" field="comment"></has-error>
                                </div>                                                                               
                                <center>
                                <!-- <button type="submit" class="diagnose btn-block btn btn-info" style="color:#fff;">Diagnose Patient</button> -->
                                 <button type="submit" class="diagnose btn-block btn btn-info" style="color:#fff;">Chẩn đoán của bệnh nhân</button>
                                </center>
                                </form>                   
                          </div>
                          <div class="modal-footer">
                              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                          </div>
                          </div>
                      </div>
                      </div> 
                  </td>                                             
            </tr>                                                              
                </tbody>
                <tfoot>
                 <tr>
                  <!-- <th>Unique ID</th>
                  <th>Name</th>
                  <th>Complain</th>
                  <th>Diagnose</th> -->
                  <th>Mã HSBA</th>
                  <th>Họ tên</th>
                  <th>Phản hồi của bệnh nhân</th>
                  <th>Chẩn đoán</th>
                </tr>
                </tfoot>
              </table>   
              
                                         
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>
</template>

<script>
    export default {
      data(){
            return {
              hospitals: {},
              // checked: true,
              form: new Form({  
                patient_id: '', 
                hospital_id: '',              
                diagnosis: '',
                comment: '',                  
                })              
            }
        },
        methods:{
          LoadHospitals(){                                            
                // this.loading = true;
                axios.get("api/hospital")
                .then((response)  =>  {
                    setTimeout(function(){
                    NProgress.done()
                    }, 1000);
                    this.hospitals = response.data;
                })              
            },           
            // LoadHospitals(){
            //      axios.get('api/hospital').then(({data}) => (this.hospitals = data));
            // },    
             addDiagnosis(){
                $('.diagnose').html('<i class="fa fa-spin fa-spinner"></i>');
                this.form.post('api/diagnose').then(
                    ()=>{
                        toast.fire({
                        type: 'success',
                        title: 'Thông tin chẩn đoán được thêm thành công!'
                        })   
                        $('.diagnose').html('Diagnose Patient'); 
                        $('#add-diagnosis').trigger('reset'); 
                    }).catch(
                        ()=>{
                        toast.fire({
                        type: 'error',
                        title: 'Thông tin nhập vào chưa đúng! <br> Hoặc <br> Dữ liệu đã tồn tại!'
                        })   
                        $('.diagnose').html('Diagnose Patient');
                        });                                      
            },       
        },        
        mounted() {
            console.log('Component mounted.')            
            this.LoadHospitals(); 
            Fire.$on('afterAction', () => {this.LoadHospitals()})                                             
        }
        
    }
</script>

