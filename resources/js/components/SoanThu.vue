<template>
  <div>
    <el-dialog :visible.sync="showSoanThu" @close="close()" title="SOẠN THƯ MỚI">
      <el-form
        :label-position="labelPosition"
        label-width="100px"
        :model="formLabelAlign"
        :rules="rules"
        ref="formLabelAlign"
      >
        <el-row :gutter="20" justify="space-around">
          <el-col>
            <el-form-item prop="user_nhan_id">
              <label style="font-size: 18px; font-weight: bold">Đến</label>
              <div>
                <multiselect
                  v-model="formLabelAlign.user_nhan_id"
                  placeholder="Người nhận"
                  label="name"
                  track-by="id"
                  :options="nguoinhans"
                >
                  <template slot="option" slot-scope="props">
                    <el-row>
                      <el-col :span="4">
                    <img
                      class="option__image"
                      :src="props.option.anh_dai_dien"
                      height="70px" width="70px"
                      style="border-radius: 50%; border: 2px solid black"
                    />
                    </el-col>
                    <el-col :span="20">
                      <br>
                      <span style="font-weight: bold">{{ props.option.name }}</span>
                      <br><br>
                      {{ props.option.email }}
                    </el-col>
                    </el-row>
                  </template>
                </multiselect>
              </div>
            </el-form-item>
          </el-col>
          <el-col>
            <el-form-item prop="mo_ta">
              <label style="font-size: 18px; font-weight: bold">Nội dung</label>
              <br />
              <textarea
                size="large"
                style="width: 100%"
                v-model="formLabelAlign.noi_dung"
                rows="2"
                placeholder="Nội dung"
              ></textarea>
            </el-form-item>
          </el-col>
          <el-button
            type="primary"
            style="width:100%;"
            :loading="loading"
            @click="submit('formLabelAlign')"
          >GỬI</el-button>
        </el-row>
      </el-form>
    </el-dialog>
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
export default {
  name: "SoanThu",
  components: {
    Multiselect
  },
  props: ["thanhvien"],
  data() {
    return {
      loading: false,
      labelPosition: "top",
      showSoanThu: false,
      formLabelAlign: {
        user_nhan_id: "",
        noi_dung: ""
      },
      nguoinhans: [],
      rules: {
        user_nhan_id: [
          {
            required: true,
            message: "Người nhận không được bỏ trống",
            trigger: "blur"
          }
        ],
        noi_dung: [
          {
            required: true,
            message: "Nội dung không được bỏ trống",
            trigger: "blur"
          },
        ]
      }
    };
  },
  props: {
    active: {
      type: Boolean,
      default: false
    }
  },
  created() {
    this.getThanhVien();
  },
  watch: {
    active(val) {
      this.showSoanThu = val;
    }
  },
  methods: {
    close() {
      this.$emit("onClose");
    },
    getThanhVien() {
      axios.get("dsthanhvien").then(res => {
        this.nguoinhans = res.data.data;
        console.log("thanh", this.nguoinhans);
      });
    },
    submit(create) {
      this.$refs[create].validate(valid => {
        if (valid) {
          this.formLabelAlign.user_nhan_id = this.formLabelAlign.user_nhan_id.id
          axios.post("/guithu", this.formLabelAlign).then(res => {
            this.loading = false;
            this.formLabelAlign.noi_dung = null;
            this.$emit("onSoanThu", true);
          });
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
