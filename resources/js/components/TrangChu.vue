<template>
  <div>
    <div class="banner">
      <img src="https://1.bp.blogspot.com/-f9fU1gJGhA4/Xbvr8mk2y-I/AAAAAAAAADM/4N-MMwwLc74xGhi8GybIfRY063rOwAU1ACEwYBhgL/s1600/banner.png" width="100%" height="500px" />
      <!-- <img src="anh/project2.jpg" width="100%" height="500px" /> -->
    </div>
    <div class="container" style="font-family: 'Open Sans'">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="title">
            <P class="mini_title">CÙNG HỌC TẬP & TRAO ĐỔI KIẾN THỨC</P>
            <h5
              style="font-family: 'Open Sans';"
            >Hệ thống chủ đề đa dạng, Được sự hỗ trợ trực tiếp từ các giảng viên Đại học Bách Khoa Hà Nội</h5>
            <div class="bar"></div>
            <div class="intro col-md-8" style="margin-bottom: 20px">
              <p>Là một hệ thống mở cho bất cứ ai, chúng tôi giúp bạn trả lời các câu hỏi thuộc nhiều chủ đề với cộng đồng người dùng lớn. Đặc biệt được sự hỗ trợ từ các giảng viên Đại học bách khoa Hà Nội</p>
            </div>
            <div class="card-columns" style="display: inline-block;">
              <div class="card" v-for="chude in chudes">
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
              </div>
            </div>
          </div>
          <div class="title">
            <P class="mini_title">CÂU HỎI MỚI CẬP NHẬT</P>
            <div class="bar"></div>
          </div>
          <div v-for="cauhoi in cauhois">
            <div class="row">
              <div class="col-md-1">
                <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
              </div>
              <div class="col-md-11">
                <a :href="`binhluan/${cauhoi.id}`">
                  <h4>{{cauhoi.tieu_de}}</h4>
                </a>
                <p>
                  Tạo bởi: <a :href="`../taikhoan/${cauhoi.user.id}`">{{cauhoi.user.name}}</a>
                  <span
                    style="margin-left: 20px"
                  >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
                  <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
                </p>
                <p>{{ cauhoi.noi_dung.substr(0, 200)}}...</p>
              </div>
            </div>
            <hr />
          </div>
          <div class="col-md-12" style="text-align:center">
            <a href="/tatcacauhoi">
              <button type="button" class="btn btn-primary">Toàn bộ câu hỏi</button>             
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["chudes"],
  data() {
    return {
      cauhois: [],
      chude: [],
      tieu_de: "",
      chu_de_id: "",
      noi_dung: ""
    };
  },
  created() {
    this.fetchData();
  },
  methods:{
    fetchData(){
      axios.get('cauhoimoi').then(res=>{
        this.cauhois = res.data.data.data
        console.log(this.cauhois)
      });
    }
  }
};
</script>