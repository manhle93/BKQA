<template>
  <div class="container" style="font-family: 'Open Sans'">
    <el-form ref="form" :model="form" label-width="130px" label-position="left">
      <el-row>
        <el-col :span="10">
          <el-form-item style="font-weight: bold">
            <label style="font-weight: bold; font-size: 18px">Thời gian đăng bài</label>
            <div class="block">
              <el-date-picker
                v-model="date"
                type="daterange"
                range-separator="-"
                start-placeholder="Từ ngày"
                end-placeholder="Đến ngày"
              ></el-date-picker>
            </div>
          </el-form-item>
        </el-col>
        <el-col :span="10">
          <el-form-item style="font-weight: bold">
            <label style="font-weight: bold; font-size: 18px">Người dùng</label>
            <el-input
              prefix-icon="el-icon-user-solid"
              v-model="form.user"
              placeholder="Tìm kiếm người dùng"
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row>
        <el-form-item>
          <i class="el-icon-edit-outline"></i>
          <label style="font-weight: bold; font-size: 18px">Nội dung</label>
          <br />
          <textarea
            placeholder=" Câu hỏi hoặc câu trả lời"
            rows="2"
            style="width: 82%"
            v-model="form.noidung"
          ></textarea>
        </el-form-item>
      </el-row>
      <el-row>
        <el-col align="center">
          <el-button type="primary" icon="el-icon-search" @click="timKiem()">Tìm kiếm</el-button>
        </el-col>
      </el-row>
    </el-form>
    <hr />
    <el-row>
      <el-col align="center">
        <label style="font-size: 26px; font-weight: bold ">KẾT QUẢ TÌM KIẾM</label>
      </el-col>
      <div v-if="ketqua">
        <el-col style="margin-top: 20px">
          <label style="font-size: 20px; font-weight: bold;">Mọi người</label>
          <div class="row">
            <div class="col-md-4" v-for="thanhvien in users">
              <div class="row">
                <div class="col-md-5">
                  <img :src="thanhvien.anh_dai_dien" style="width: 120px; height:120px" />
                </div>
                <div class="col-md-7">
                  <a
                    :href="`../taikhoan/${thanhvien.id}`"
                    style="font-weight:bold; font-size: 16px"
                  >{{thanhvien.name}}</a>
                  <p style="font-size: 14px">Email: {{thanhvien.email}}</p>
                  <p style="font-size: 14px">Ngày tham gia: {{formatDate(thanhvien.created_at)}}</p>
                  <p style="font-size: 14px">Vai trò:</p>
                </div>
              </div>
            </div>
          </div>
        </el-col>
        <el-col style="margin-top: 20px">
          <label style="font-size: 20px; font-weight: bold ">
            Bài viết
            <span
              v-if="date != null && date != ''"
            >từ ngày {{formatDate(date[0])}} đến ngày {{formatDate(date[1])}}</span>
          </label>
          <div v-for="cauhoi in cauhois">
            <div class="row">
              <div class="col-md-1">
                <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-11">
                <a :href="`../binhluan/${cauhoi.id}`">
                  <h4>{{cauhoi.tieu_de}}</h4>
                </a>
                <p style="font-size: 16px">
                  Tạo bởi:
                  {{cauhoi.user.name}}
                  <span
                    style="margin-left: 20px"
                  >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
                  <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
                </p>
                <p style="font-size: 18px">{{ cauhoi.noi_dung.substr(0, 200)}}...</p>
              </div>
            </div>
            <hr />
          </div>
        </el-col>
        <el-col style="margin-top: 20px">
          <label style="font-size: 20px; font-weight: bold ">Bài viết của người dùng</label>
          <div v-for="cauhoi in cauhoi_users">
            <div class="row">
              <div class="col-md-1">
                <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-11">
                <a :href="`../binhluan/${cauhoi.id}`">
                  <h4>{{cauhoi.tieu_de}}</h4>
                </a>
                <p style="font-size: 16px">
                  Tạo bởi:
                  {{cauhoi.user.name}}
                  <span
                    style="margin-left: 20px"
                  >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
                  <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
                </p>
                <p style="font-size: 18px">{{ cauhoi.noi_dung.substr(0, 200)}}...</p>
              </div>
            </div>
            <hr />
          </div>
        </el-col>
      </div>
    </el-row>
  </div>
</template>
<script>
export default {
  data() {
    return {
      pickerOptions: {
        shortcuts: [
          {
            text: "Last week",
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit("pick", [start, end]);
            }
          },
          {
            text: "Last month",
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
              picker.$emit("pick", [start, end]);
            }
          },
          {
            text: "Last 3 months",
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
              picker.$emit("pick", [start, end]);
            }
          }
        ]
      },
      ketqua: false,
      date: [],
      form: {
        tu_ngay: "",
        den_ngay: "",
        user: "",
        noidung: ""
      },
      cauhois: "",
      users: "",
      cauhoi_users: ""
    };
  },
  methods: {
    formatDate(date) {
      let current_datetime = new Date(date);
      let formatted_date =
        current_datetime.getDate() +
        "/" +
        (current_datetime.getMonth() + 1) +
        "/" +
        current_datetime.getFullYear();
      return formatted_date;
    },
    timKiem() {
      this.ketqua = true;
      if (this.date != null) {
        this.form.tu_ngay = this.date[0];
        this.form.den_ngay = this.date[1];
      }
      if (this.date == null) {
        this.form.tu_ngay = [];
        this.form.den_ngay = [];
      }
      axios.post("xulytimkiemnangcao", this.form).then(res => {
        console.log(res.data);
        this.cauhois = res.data.cauhoi;
        this.users = res.data.user;
        this.cauhoi_users = res.data.cauhoi_user;
      });
    }
  }
};
</script>