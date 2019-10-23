<template>
  <div>
    <el-dialog :visible.sync="showFormBaoCao" @close="close()" title="BÁO CÁO VI PHẠM" width="30%">
      <el-form
        :label-position="labelPosition"
        label-width="100px"
        :model="formLabelAlign"
        :rules="rules"
        ref="formLabelAlign"
      >
        <el-row :gutter="20" justify="space-around">
          <el-col style="font-size: 16px;">
              <p >Gửi báo cáo vi phạm!</p>
             <p> Với các câu hỏi trùng lặp, câu trả lời câu hỏi vi phạm thuần phong mỹ tục, gây ảnh hưởng đến người khác. Hãy gửi báo cáo cho chúng tôi </p>
          </el-col>
          <el-col>
            <el-form-item prop="noi_dung">
              <label style="font-size: 16px; font-weight: bold">Nội dung báo cáo</label>
              <br />
              <textarea
                size="large"
                style="width: 100%"
                v-model="formLabelAlign.noi_dung"
                rows="2"
                placeholder="Nhập lý do báo cáo"
              ></textarea>
            </el-form-item>
          </el-col>
          <el-button
            type="primary"
            style="width:100%;"
            :loading="loading"
            @click="submit('formLabelAlign')"
          >Gửi báo cáo</el-button>
        </el-row>
      </el-form>
    </el-dialog>
  </div>
</template>
<script>
export default {
  name: "BaoCao",
  data() {
    return {
      loading: false,
      labelPosition: "top",
      showFormBaoCao: false,
      formLabelAlign: {
        cau_tra_loi_id: '',
        noi_dung: "",
        cau_hoi_bao_cao_id: ''
      },
      rules: {
        noi_dung: [
          {
            required: true,
            message: "Nội dung mô tả không được bỏ trống",
            trigger: "blur"
          }
        ]
      }
    };
  },
  props: {
    active: {
      type: Boolean,
      default: false
    },
    CauTraLoi: { type: Number},
    CauHoi: {type: Number}
  },
  watch: {
    active(val) {
      this.showFormBaoCao = val;
    },
        CauHoi(val){
        this.formLabelAlign.cau_hoi_bao_cao_id = val
    },
    CauTraLoi(val){
        this.formLabelAlign.cau_tra_loi_id = val
    }
  },
  methods: {
    close() {
      this.$emit("onClose");
    },
    submit(create) {
      this.$refs[create].validate(valid => {
        if (valid) {
        this.loading = true;
        axios.post(`/baocaovipham`, this.formLabelAlign).then(res =>{
        this.loading = false;
        this.close();
        this.formLabelAlign.noi_dung = null;
        this.$message({
        message: "Đã báo cáo vi phạm",
        type: "success"
      });
        })
        } else {
          return false;
        }
      });
    }
  }
};
</script>
<style>
</style>
