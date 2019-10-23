<template>
  <div class="container" style="font-family: 'Open Sans'">
    <div>
      <div class="row">
        <div class="col-md-3" style="text-align:center">
          <img :src="imageUrl" style="width: 180px; height:180px" />
          <input ref="upload-image" class="upload-image" type="file" @change="handleChange($event)" />
          <br />
          <br />
          <el-tooltip class="item" effect="dark" content="Thay đổi ảnh đại diện" placement="top">
            <el-button @click="handleUpload()" type="primary" icon="el-icon-edit" circle></el-button>
          </el-tooltip>
        </div>
        <div class="col-md-9">
          <h4 style="font-weight:bold; font-size: 24px">{{user.name}}</h4>
          <p style="font-size: 20px">Email: {{user.email}}</p>
          <p style="font-size: 20px">Ngày tham gia: {{formatDate(user.created_at)}}</p>
          <p style="font-size: 20px">Vai trò: {{user.quyen.ten}} - {{user.quyen.mo_ta}}</p>
        </div>
      </div>
    </div>
    <Them-Chude
      :active="showAddForm"
      @onClose="handleClose()"
      @onThemChuDe="ChuDe => handleThemChuDe(ChuDe)"
    ></Them-Chude>
    <Sua-Chude
      :ChuDeEdit="ChuDe"
      :active="showEditForm"
      @onClose="handleClose()"
      @onEditChude="result => handleEditChude(result)"
    ></Sua-Chude>
    <Soan-Thu
      :active="showFormSoanThu"
      @onClose="handleClose()"
      @onSoanThu="SoanThu => handleSoanThu(SoanThu)"
    ></Soan-Thu>
    <hr />
    <div>
      <div class="tabs">
        <a
          v-on:click="activetab=1"
          v-bind:class="[ activetab === 1 ? 'active' : '' ]"
        >Bài viết được duyệt</a>
        <a
          v-on:click="activetab=2"
          v-bind:class="[ activetab === 2 ? 'active' : '' ]"
        >Câu hỏi chờ phê duyệt</a>
        <a
          v-on:click="activetab=3"
          v-bind:class="[ activetab === 3 ? 'active' : '' ]"
          v-if="(user.quyen_id == 1 || user.quyen_id == 2)"
        >Báo cáo vi phạm</a>
        <a v-on:click="activetab=4" v-bind:class="[ activetab === 4 ? 'active' : '' ]">Chủ đề</a>
        <a v-on:click="activetab=5" v-bind:class="[ activetab === 5 ? 'active' : '' ]">Thành viên</a>
        <a v-on:click="activetab=6" v-bind:class="[ activetab === 6 ? 'active' : '' ]">Hộp thư</a>
        <a
          v-on:click="activetab=7"
          v-bind:class="[ activetab === 7 ? 'active' : '' ]"
        >Lịch sử đăng nhập</a>
      </div>

      <div class="content">
        <div v-if="activetab === 1" class="tabcontent">
          <div v-for="cauhoi in cauhois">
            <div class="row">
              <div class="col-md-1">
                <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-10">
                <a :href="`../binhluan/${cauhoi.id}`">
                  <h4>{{cauhoi.tieu_de}}</h4>
                </a>
                <p style="font-size: 16px">
                  Tạo bởi:
                  {{user.name}}
                  <span
                    style="margin-left: 20px"
                  >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
                  <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
                </p>
                <p style="font-size: 18px">{{ cauhoi.noi_dung.substr(0, 200)}}...</p>
              </div>
              <div class="col-md-1">
                <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
                  <el-button
                    @click="xoaCauHoi(cauhoi.id)"
                    type="danger"
                    icon="el-icon-delete"
                    circle
                  ></el-button>
                </el-tooltip>
              </div>
            </div>
            <hr />
          </div>
        </div>
        <div v-if="activetab === 2" class="tabcontent">
          <div v-for="cauhoichoduyet in cau_hoi_cho_duyet">
            <div class="row">
              <div class="col-md-1">
                <img :src="cauhoichoduyet.user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-9">
                <a :href="`../binhluan/${cauhoichoduyet.id}`">
                  <h4>{{cauhoichoduyet.tieu_de}}</h4>
                </a>
                <p style="font-size: 16px">
                  Tạo bởi:
                  {{cauhoichoduyet.user.name}}
                  <span
                    style="margin-left: 20px"
                  >Chủ đề: {{cauhoichoduyet.chu_de.tieu_de}}</span>
                  <span style="margin-left: 20px">Thời gian: {{cauhoichoduyet.created_at}}</span>
                </p>
                <p style="font-size: 18px">{{ cauhoichoduyet.noi_dung.substr(0, 200)}}...</p>
              </div>
              <div class="col-md-2">
                <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
                  <el-button
                    size="small"
                    @click="xoaCauHoi(cauhoichoduyet.id)"
                    type="danger"
                    icon="el-icon-delete"
                    circle
                  ></el-button>
                </el-tooltip>
                <el-tooltip class="item" effect="dark" content="Phê duyệt" placement="top">
                  <el-button
                    v-if="(user.quyen_id == 1 || user.quyen_id == 2)"
                    size="small"
                    @click="pheDuyet(cauhoichoduyet.id)"
                    type="success"
                    icon="el-icon-check"
                    circle
                  ></el-button>
                </el-tooltip>
              </div>
            </div>
            <hr />
          </div>
        </div>
        <div
          v-if="activetab === 3 && (user.quyen_id == 1 || user.quyen_id == 2)"
          class="tabcontent"
        >
         <el-tabs v-model="activeName2">
           <el-tab-pane label="Câu trả lời vi phạm" name="first">
             <br><h4>Danh sách báo cáo câu trả lời vi phạm</h4><br>
          <div v-for="bao_cao in bao_cao_vi_pham">
            <div class="row">
              <div class="col-md-1">
                <img :src="bao_cao.user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-9">
                <p style="font-size: 18px;">
                  <a :href="`../taikhoan/${bao_cao.user.id}`">{{bao_cao.user.name}}</a> Đã trả lời
                  <span style="margin-left: 20px">Thời gian: {{bao_cao.created_at}}</span>
                </p>
                <p
                  style="font-size: 20px; font-weight: bold"
                >{{ bao_cao.noi_dung.substr(0, 200)}}...</p>Báo cáo bởi:
                <div v-for="nguoibaocao in bao_cao.bao_cao_vi_pham ">
                  <a :href="`../taikhoan/${nguoibaocao.user.id}`">{{nguoibaocao.user.name}},</a>
                  Lý do: {{nguoibaocao.noi_dung}}
                  <br>
                </div>
              </div>
              <div class="col-md-2">
                <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
                  <el-button
                    size="small"
                    @click="xoaViPham(bao_cao.id)"
                    type="danger"
                    icon="el-icon-delete"
                    circle
                  ></el-button>
                </el-tooltip>
                <el-tooltip class="item" effect="dark" content="Bỏ qua" placement="top">
                  <el-button
                    v-if="(user.quyen_id == 1 || user.quyen_id == 2)"
                    size="small"
                    @click="boQuaCauTraLoi(bao_cao.id)"
                    type="success"
                    icon="el-icon-check"
                    circle
                  ></el-button>
                </el-tooltip>
              </div>
            </div>
            <hr />
          </div>
          </el-tab-pane>
          <el-tab-pane label="Câu hỏi vi phạm" name="second">
            <br><h4>Danh sách báo cáo câu hỏi vi phạm</h4><br>
            <div v-for="cauhoi in cau_hoi_vi_pham">
            <div class="row">
              <div class="col-md-1">
                <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-9">
                <a :href="`../binhluan/${cauhoi.id}`">
                  <h4>{{cauhoi.tieu_de}}</h4>
                </a>
                <p style="font-size: 16px">
                  Tạo bởi:
                  {{user.name}}
                  <span
                    style="margin-left: 20px"
                  >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
                  <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
                </p>
                <p style="font-size: 18px">{{ cauhoi.noi_dung.substr(0, 200)}}...</p>
                Báo cáo bởi:
                <div v-for="nguoibaocao in cauhoi.bao_cao_vi_pham ">
                  <a :href="`../taikhoan/${nguoibaocao.user.id}`">{{nguoibaocao.user.name}},</a>
                  Lý do: {{nguoibaocao.noi_dung}}
                  <br>
                </div>
              </div>
              <div class="col-md-2">
                <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
                  <el-button
                    size="small"
                    @click="xoaCauHoi(cauhoi.id)"
                    type="danger"
                    icon="el-icon-delete"
                    circle
                  ></el-button>
                </el-tooltip>
                <el-tooltip class="item" effect="dark" content="Bỏ qua" placement="top">
                  <el-button
                    v-if="(user.quyen_id == 1 || user.quyen_id == 2)"
                    size="small"
                    @click="boQuaCauHoi(cauhoi.id)"
                    type="success"
                    icon="el-icon-check"
                    circle
                  ></el-button>
                </el-tooltip>
              </div>
            </div>
            <hr />
          </div>
            </el-tab-pane>
          </el-tabs>
        </div>
        <div v-if="activetab === 4" class="tabcontent">
          <el-button
            icon="el-icon-folder-add"
            type="primary"
            v-if="user.quyen_id == 1 || user.quyen_id == 2"
            @click="themChuDe()"
          >THÊM CHỦ ĐỀ</el-button>
          <div class="card-columns" style="display: inline-block; margin-top: 20px">
            <div class="card" v-for="chude in chudes" style="text-align: center">
              <img :src="chude.anh_dai_dien" class="card-img-top" />
              <div class="card-body">
                <h4
                  class="card-title"
                  style="font-family: 'Open Sans'; font-weight:bold"
                >{{chude.tieu_de}}</h4>
                <p class="card-text">{{ chude.mo_ta.substr(0, 60) }}...</p>
                <p>{{chude.so_cau_hoi}} Câu hỏi</p>
              </div>
              <a
                :href="`cauhoichude/${chude.id}`"
                class="btn btn-success"
                style="margin-bottom: 20px"
              >Xem chi tiết</a>
              <div v-if="user.quyen_id == 1 || user.quyen_id == 2">
                <el-button
                  size="small"
                  type="primary"
                  @click="suaChuDe(chude)"
                  icon="el-icon-edit"
                  circle
                ></el-button>
                <el-button
                  size="small"
                  type="danger"
                  @click="xoaChuDe(chude.id)"
                  icon="el-icon-delete"
                  circle
                ></el-button>
              </div>
              <br />
            </div>
          </div>
        </div>
        <div v-if="activetab === 5" class="tabcontent">
          <div class="row">
            <div class="col-md-4" v-for="thanhvien in dsthanhvien">
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
                  <p style="font-size: 14px">
                    Vai trò:
                    <span
                      v-if="user.quyen_id == 4 || user.quyen_id == 3"
                    >{{thanhvien.quyen.ten}}</span>
                    <span v-else>
                      <el-select
                        :disabled="(thanhvien.quyen.id == 1 && user.quyen_id !=1) || thanhvien.quyen.id == user.quyen_id "
                        v-model="thanhvien.quyen.id"
                        placeholder="Chọn quyền"
                        style="width: 70%"
                        size="small"
                        @change="setQuyen(thanhvien.id, thanhvien.quyen.id)"
                      >
                        <el-option
                          v-for="item in quyens"
                          :key="item.id"
                          :label="item.ten"
                          :value="item.id"
                          :disabled="item.disabled"
                        ></el-option>
                      </el-select>
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="activetab === 6" class="tabcontent">
          <el-button type="primary" style="margin-bottom: 15px" @click="soanThu()">Soạn thư</el-button>
          <el-tabs v-model="activeName">
            <el-tab-pane label="Hộp thư đến" name="first">
              <div v-for="(thuden, index ) in thu_den">
                <div class="row">
                  <div class="col-md-1">
                    <img :src="thuden.user_gui.anh_dai_dien" style="width: 80px; height:80px; border-radius: 50%; border: 1px solid black" />
                  </div>
                  <div class="col-md-10">
                    <div>
                      <div style="font-size: 18px; font-style: italic; margin-bottom: 5px">
                        Gửi từ:
                        <span
                          style="font-weight: bold;font-style: normal;"
                        >{{thuden.user_nhan.name}}</span>
                      </div>
                      <div>{{formatDate(thuden.created_at)}}</div>
                    </div>
                    <div>
                      <el-collapse v-model="activeNames">
                        <el-collapse-item :name="index">
                          <template slot="title">
                              <el-button type="primary" icon="el-icon-view" style="margin-right: 5px" circle size="mini"></el-button>
                            <span style="font-size: 16px;">Xem nội dung</span>
                          </template>
                          <p style="font-size: 20px; margin-top: 10px">{{ thuden.noi_dung}}</p>
                        </el-collapse-item>
                      </el-collapse>
                    </div>
                  </div>
                  <!-- <div class="col-md-1">
                    <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
                      <el-button type="danger" icon="el-icon-delete" circle></el-button>
                    </el-tooltip>
                  </div> -->
                </div>
                <hr />
              </div>
            </el-tab-pane>
            <el-tab-pane label="Thư đã gửi" name="second">
              <div v-for="(thu, index) in thu_da_gui">
                <div class="row">
                  <div class="col-md-1">
                    <img :src="thu.user_nhan.anh_dai_dien" style="width: 80px; height:80px; border-radius: 50%; border: 1px solid black" />
                  </div>
                  <div class="col-md-10" style="margin-left: 5px">
                    <div>
                      <div style="font-size: 18px; font-style: italic; margin-bottom: 5px">
                        Gửi đến:
                        <span style="font-weight: bold;font-style: normal;">{{thu.user_nhan.name}}</span>
                      </div>
                      <div>{{formatDate(thu.created_at)}}</div>
                    </div>
                    <div>
                      <el-collapse v-model="activeNames">
                        <el-collapse-item :name="index">
                          <template slot="title">
                            <i class="el-icon-view" style="font-size: 16px; margin-right: 5px"></i>
                            <span style="font-size: 16px;">Xem nội dung</span>
                          </template>
                          <p style="font-size: 20px; margin-top: 10px">{{ thu.noi_dung}}</p>
                        </el-collapse-item>
                      </el-collapse>
                    </div>
                  </div>
                  <!-- <div class="col-md-1">
                    <el-tooltip class="item" effect="dark" content="Xóa" placement="top">
                      <el-button type="danger" icon="el-icon-delete" circle></el-button>
                    </el-tooltip>
                  </div>-->
                </div>
                <hr />
              </div>
            </el-tab-pane>
          </el-tabs>
        </div>
        <div v-if="activetab === 7" class="tabcontent">
          <h4>Lịch sử đăng nhập</h4>
          <br />
          <el-table :data="lich_su" border style="width: 100%">
            <el-table-column label="STT" width="90" align="center">
              <template slot-scope="scope">{{ scope.$index +1 }}</template>
            </el-table-column>
            <el-table-column label="Thời gian" width="180">
              <template slot-scope="scope">{{ formatTimeLogIn(scope.row.created_at)}}</template>
            </el-table-column>
            <el-table-column prop="noi_dung" label="Chi tiết"></el-table-column>
          </el-table>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ThemChude from "./ThemChuDe";
import SuaChude from "./SuaChuDe";
import SoanThu from "./SoanThu";

export default {
  props: ["user"],
  data() {
    return {
      activeName: "first",
      activeName2: "first",
      chon_quyen: true,
      ChuDe: null,
      SoanThu: null,
      showFormSoanThu: false,
      showAddForm: false,
      showEditForm: false,
      noi_dung: "",
      quyens: [],
      activetab: 1,
      quyen_id: "",
      cauhois: [],
      dsthanhvien: [],
      chudes: [],
      imageUrl: this.user.anh_dai_dien,
      cau_hoi_cho_duyet: [],
      bao_cao_vi_pham: [],
      lich_su: [],
      thu_da_gui: [],
      thu_den: [],
      activeNames: [],
      cau_hoi_vi_pham: []
    };
  },
  created() {
    this.getThanhVien();
    this.getChuDe();
    this.layCauHoi();
    this.getCauHoiChoDuyet();
    this.getQuyen();
    this.getViPham();
    this.getLichSu();
    this.getThu();
  },
  methods: {
    layCauHoi() {
      axios.get(`cauhoitheotaikhoan/${this.user.id}`).then(res => {
        this.cauhois = res.data.data;
      });
    },
    async getViPham() {
      let data = await axios.get("baocaovipham");
      this.bao_cao_vi_pham = data.data.cautraloi;
      this.cau_hoi_vi_pham = data.data.cauhoi
      console.log('cau_hoi_vi_pham',this.cau_hoi_vi_pham);
    },
    xoaViPham(id) {
      this.$confirm("Xóa câu trả lời vi phạm?", "Xóa câu trả lời", {
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy",
        type: "warning"
      })
        .then(_ => {
          axios.delete(`xoacautraloi/${id}`).then(res => {
            this.$message({
              message: "Xóa thành công",
              type: "success"
            });
            this.getViPham();
          });
        })
        .catch(_ => {});
    },
    boQuaCauTraLoi(id) {
      this.$confirm("Nội dung không vi phạm", "Bỏ qua", {
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy",
        type: "warning"
      })
        .then(_ => {
          axios.delete(`boquacautraloivipham/${id}`).then(res => {
            this.$message({
              message: "Đã bỏ qua vi phạm",
              type: "success"
            });
            this.getViPham();
          });
        })
        .catch(_ => {});
    },
    boQuaCauHoi(id) {
      this.$confirm("Nội dung không vi phạm", "Bỏ qua", {
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy",
        type: "warning"
      })
        .then(_ => {
          axios.delete(`boquacauhoivipham/${id}`).then(res => {
            this.$message({
              message: "Đã bỏ qua vi phạm",
              type: "success"
            });
            this.getViPham();
          });
        })
        .catch(_ => {});
    },
    async getQuyen() {
      let data = await axios.get("getquyen");
      this.quyens = data.data.data;
      for (let quyen of this.quyens) {
        if (this.user.quyen_id == 2 && quyen.id == 1) {
          quyen.disabled = true;
        }
      }
    },
    async setQuyen(id_thanhvien, id_quyen) {
      await axios.post(`thaydoiquyen/${id_thanhvien}`, { quyen_id: id_quyen });
      this.$message({
        title: "Thành công",
        message: "Đã thay đổi quyền",
        type: "success"
      });
    },
    async getLichSu() {
      let data = await axios.get("/lichsu");
      this.lich_su = data.data.data;
    },
    getCauHoiChoDuyet() {
      axios.get("cauhoichoduyet").then(res => {
        this.cau_hoi_cho_duyet = res.data.data;
      });
    },
    handleUpload() {
      this.$refs["upload-image"].click();
    },
    themChuDe() {
      this.showAddForm = true;
    },
    soanThu() {
      this.showFormSoanThu = true;
    },
    suaChuDe(ChuDe) {
      this.showEditForm = true;
      this.ChuDe = ChuDe;
    },
    handleThemChuDe(result) {
      if (result === true) {
        this.handleClose();
        this.$message({
          title: "Thành công",
          message: "Thêm mới thành công",
          type: "success"
        });
        this.getChuDe();
      }
    },
    handleEditChude(result) {
      if (result === true) {
        this.showEditForm = false;
        this.$emit("onEditRoom", true);
        this.$message({
          title: "Thành công",
          message: "Cập nhật thành công",
          type: "success"
        });
      }
    },
    handleChange(e) {
      let files = e.target.files;
      let data = new FormData();
      data.append("file", files[0]);
      axios
        .post("uploadavatar", data, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(res => {
          this.imageUrl = res.data;
          location.reload();
        })
        .catch(err => {});
    },
    handleSoanThu(result) {
      if (result === true) {
        this.handleClose();
        this.$message({
          title: "Thành công",
          message: "Gửi thư thành công",
          type: "success"
        });
        // this.getChuDe();
      }
    },
    getThanhVien() {
      axios.get("dsthanhvien").then(res => {
        this.dsthanhvien = res.data.data;
      });
    },
    getChuDe() {
      axios.get("getchude").then(res => {
        this.chudes = res.data.data;
      });
    },
    formatDate(d) {
      var a = new Date(d);
      return (
        this.addZero(a.getHours()) +
        ":" +
        this.addZero(a.getMinutes()) +
        ", Ngày " +
        this.addZero(a.getDate()) +
        "/" +
        this.addZero(a.getMonth() + 1) +
        "/" +
        a.getUTCFullYear()
      );
    },
    handleClose() {
      this.showAddForm = false;
      this.showEditForm = false;
      this.showFormSoanThu = false;
      this.$emit("onRefresh");
    },
    xoaCauHoi(id) {
      this.$confirm("Bạn có chắc chắn muốn xóa câu hỏi này?", "Xóa câu hỏi", {
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy",
        type: "warning"
      }).then(_ => {
        axios.delete(`/xoacauhoi/${id}`).then(res => {
          this.$message({
            message: "Đã xóa câu hỏi",
            type: "success"
          });
          this.layCauHoi();
          this.getCauHoiChoDuyet();
        });
      });
    },
    pheDuyet(id) {
      axios.post(`pheduyetcauhoi/${id}`).then(res => {
        this.$message({
          message: "Đã phê duyệt câu hỏi",
          type: "success"
        });
      });
      this.getCauHoiChoDuyet();
      this.layCauHoi();
    },
    xoaChuDe(id) {
      this.$confirm(
        "Xóa chủ đề cùng toàn bộ câu hỏi trong chủ đề?",
        "Xóa chủ đề",
        {
          confirmButtonText: "Xóa",
          cancelButtonText: "Hủy",
          type: "warning"
        }
      )
        .then(_ => {
          axios.delete(`xoachude/${id}`).then(res => {
            this.$message({
              message: "Xóa thành công",
              type: "success"
            });
            this.getChuDe();
          });
        })
        .catch(_ => {});
    },
    addZero(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    },
    formatTimeLogIn(d) {
      var a = new Date(d);
      return (
        this.addZero(a.getDate()) +
        "/" +
        this.addZero(a.getMonth() + 1) +
        "/" +
        a.getFullYear() +
        ", " +
        this.addZero(a.getHours()) +
        ":" +
        this.addZero(a.getMinutes())
      );
    },
    async getThu() {
      let data = await axios.get("/getthu");
      this.thu_da_gui = data.data.thugui;
      this.thu_den = data.data.thuden;
    }
  }
};
</script>
<style scoped>
/* RESET */

/* Style the tabs */
.tabs {
  overflow: hidden;
  margin-left: 20px;
  margin-bottom: -2px;
}

.tabs ul {
  list-style-type: none;
  margin-left: 20px;
}

.tabs a {
  float: left;
  cursor: pointer;
  padding: 12px 24px;
  transition: background-color 0.2s;
  border: 1px solid #ccc;
  border-right: none;
  background-color: #f1f1f1;
  border-radius: 10px 10px 0 0;
  font-weight: bold;
}
.tabs a:last-child {
  border-right: 1px solid #ccc;
}

/* Change background color of tabs on hover */
.tabs a:hover {
  background-color: #aaa;
  color: #fff;
}

/* Styling for active tab */
.tabs a.active {
  background-color: #fff;
  color: #484848;
  border-bottom: 2px solid #fff;
  cursor: default;
}

/* Style the tab content */
.tabcontent {
  padding: 30px;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 3px 3px 6px #e1e1e1;
}
.upload-image {
  display: none;
  z-index: -9999;
}
</style>
