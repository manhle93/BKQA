<template>
  <div class="container" style="font-family: 'Open Sans';">
    <div>
      <FlashMessage></FlashMessage>
      <Bao-Cao :active="showFormBaoCao" :CauTraLoi="CauTraLoi" :CauHoi="CauHoi" @onClose="handleClose()"></Bao-Cao>
      <div class="row">
        <div class="col-md-1">
          <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
        </div>
        <div class="col-md-9">
          <p style="font-weight:bold; font-size: 20px">{{cauhoi.tieu_de}}</p>
          <p style="font-size: 18px ;">
            Tạo bởi: <a :href="`../taikhoan/${cauhoi.user.id}`"> {{cauhoi.user.name}}</a>
            <span
              style="margin-left: 20px"
            >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
            <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
          </p>
        </div>
        <div v-if="user_login != null" class="col-md-2">
          <el-tooltip class="item" effect="dark" content="Báo cáo vi phạm" placement="top">
            <el-button
              @click="baoCaoCauHoi(cauhoi.id)"
              type="warning"
              icon="el-icon-edit"
              circle
            ></el-button>
          </el-tooltip>
          <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
            <el-button
              v-if="user_login.id == cauhoi.user.id || user_login.quyen_id == 1 || user_login.quyen_id == 2"
              @click="xoaCauHoi(cauhoi.id)"
              type="danger"
              icon="el-icon-delete"
              circle
            ></el-button>
          </el-tooltip>
        </div>
      </div>
      <br />
      <p style="font-family: 'Open Sans'; font-size: 20px">{{cauhoi.noi_dung}}</p>
    </div>
    <hr />
    <div>
      <h4 style="font-family: 'Open Sans'; font-weight:bold">Trả lời</h4>
      <textarea rows="3" class="form-control" style="font-size: 20px" v-model="noi_dung"></textarea>
      <br />
      <button
      :disabled="user_login == null || noi_dung.trim() == ''"
        type="button"
        style="font-family: 'Open Sans'; font-size: 18px"
        @click="binhluan()"
        class="btn btn-primary"
      >Trả lời</button>
    </div>
    <hr />
    <div>
      <h4>{{so_cau_tra_loi}} Câu trả lời</h4>
      <br />
      <div v-for="cautraloi in cautralois">
        <div class="row">
          <div class="col-md-1">
            <img :src="cautraloi.user.anh_dai_dien" style="width: 60px; height: 60px" />
          </div>
          <div class="col-md-8">
            <p>
              <a :href="`../taikhoan/${cautraloi.user.id}`"><span style="font-weight:bold">{{cautraloi.user.name}}</span></a>
              Đã trả lời
              <el-tooltip class="item" effect="dark" content="Số lượt Vote" placement="top">
                <el-button
                  size="mini"
                  style="font-weight: bold"
                  type="success"
                  icon="el-icon-check"
                  circle
                >{{cautraloi.votes.length}}</el-button>
              </el-tooltip>
            </p>
            <p>Thời gian: {{cautraloi.created_at}}</p>
          </div>
          <div class="col-md-3">
            <el-tooltip class="item" effect="dark" content="Vote" placement="top">
              <a @click="vote(cautraloi.id)">
                <img
                  src="/anh/vote.png"
                  v-if="user_login !=null && (cautraloi.votes.find(x=>x.user_id == user_login.id) == x)"
                  style="width: 40px; height: 40px"
                />
              </a>
              <!-- <el-button type="success" icon="el-icon-check" v-if="user_login !=null && (cautraloi.votes.find(x=>x.user_id == user_login.id) == x)" @click="vote(cautraloi.id)" circle></el-button> -->
            </el-tooltip>
            <el-tooltip class="item" effect="dark" content="Bỏ Vote" placement="top">
              <a>
                <img
                  src="/anh/unvote.png"
                  v-if="user_login !=null && (cautraloi.votes.find(x=>x.user_id == user_login.id) != x)"
                  @click="unVote(cautraloi.id)"
                  style="width: 40px; height: 40px"
                />
              </a>
              <!-- <el-button type="danger" icon="el-icon-close" v-if="user_login !=null && (cautraloi.votes.find(x=>x.user_id == user_login.id) != x)" @click="unVote(cautraloi.id)" circle></el-button> -->
            </el-tooltip>
            <el-tooltip
              v-if="user_login !=null && user_login.id != cautraloi.user.id"
              class="item"
              effect="dark"
              content="Báo cáo vi phạm"
              placement="top"
            >
              <el-button @click="baoCaoCauTraLoi(cautraloi.id)" type="warning" icon="el-icon-edit" circle></el-button>
            </el-tooltip>
            <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
              <el-button
                v-if="user_login !=null && (user_login.id == cautraloi.user_id || user_login.id == cauhoi.user.id || user_login.quyen_id == 1 || user_login.quyen_id == 2)"
                @click="xoaBinhLuan(cautraloi.id)"
                type="danger"
                icon="el-icon-delete"
                circle
              ></el-button>
            </el-tooltip>
          </div>
        </div>
        <p style="font-size: 20px">{{cautraloi.noi_dung}}</p>
        <hr />
      </div>
    </div>
  </div>
</template>
<script>
import BaoCao from "./BaoCao"
export default {
  props: ["cauhoi"],
  data() {
    return {
      showFormBaoCao: false,
      so_cau_tra_loi: 0,
      noi_dung: "",
      CauTraLoi: null,
      CauHoi: null,
      user_login: "",
      cautralois: [],
      user_votes: [],
      x: undefined
    };
  },
  created() {
    this.taiKhoanDangNhap();
    this.getBinhLuan();
    this.so_cau_tra_loi = this.cauhoi.so_cau_tra_loi;
  },
  methods: {
    binhluan() {
      axios
        .post(`/binhluan/${this.cauhoi.id}`, {
          noi_dung: this.noi_dung
        })
        .then(response => {
          this.noi_dung = "";
          this.$message({
            message: "Đã gửi câu trả lời",
            type: "success"
          });
          this.so_cau_tra_loi += 1;
          this.getBinhLuan();
        });
    },
    handleClose(){
      this.showFormBaoCao = false;
      this.$emit("onRefresh");
    },
    baoCaoCauHoi(id) {
       this.showFormBaoCao = true;
       this.CauTraLoi = null
       this.CauHoi = id;
    },

    baoCaoCauTraLoi(id) {
      this.showFormBaoCao = true;
      this.CauTraLoi = id;
      this.CauHoi = null
    },
    getBinhLuan() {
      axios.get(`/cautraloi/${this.cauhoi.id}`).then(res => {
        this.cautralois = res.data.data;
        console.log(this.cautralois);
      });
    },
    xoaCauHoi() {
      this.$confirm("Bạn có chắc chắn muốn xóa câu hỏi này?", "Xóa câu hỏi", {
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy",
        type: "warning"
      }).then(_ => {
        axios.delete(`/xoacauhoi/${this.cauhoi.id}`).then(res => {
          this.$message({
            message: "Đã xóa câu hỏi",
            type: "success"
          });
          setTimeout(() => {
            window.location.href = "/tatcacauhoi";
          }, 2000);
        });
      });
    },
    vote(id) {
      axios.post(`/vote/${id}`, { cau_hoi_id: this.cauhoi.id }).then(res => {
        this.$message({
          message: "Vote !",
          type: "success"
        });
        this.getBinhLuan();
      });
    },
    unVote(id) {
      axios.delete(`/unvote/${id}`).then(res => {
        this.$message({
          message: "Bỏ vote",
          type: "warning"
        });
        this.getBinhLuan();
      });
    },
    taiKhoanDangNhap() {
      axios.get("../kiemtradangnhap").then(res => {
        this.user_login = res.data.data;
        console.log(this.user_login);
      });
    },
    xoaBinhLuan(id) {
      this.$confirm(
        "Bạn có chắc chắn muốn xóa câu trả lời này?",
        "Xóa câu trả lời",
        {
          confirmButtonText: "Xóa",
          cancelButtonText: "Hủy",
          type: "warning"
        }
      ).then(_ => {
        axios.delete(`/xoacautraloi/${id}`).then(res => {
          this.$message({
            message: "Đã xóa bình luận",
            type: "success"
          });
          this.so_cau_tra_loi -= 1;
          this.getBinhLuan();
        });
      });
    }
  }
};
</script>
<style scoped>
</style>