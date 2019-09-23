<template>
  <div class="container" style="font-family: 'Open Sans'">
    <div class="card-columns" style="text-align:center;">
      <div class="card" v-for="chude in chudes" style="display: inline-block;">
        <img :src="chude.anh_dai_dien" class="card-img-top" />
        <div class="card-body">
          <h4
            class="card-title"
            style="font-family: 'Open Sans'; font-weight:bold"
          >{{chude.tieu_de}}</h4>
          <!-- <p class="card-text">{{ Str::limit($chuDe->mo_ta, 60) }}</p> -->
          <p>{{chude.so_cau_hoi}} Câu hỏi</p>
        </div>
        <a
          :href="'cauhoichude/'+chude.id"
          class="btn btn-success"
          style="margin-bottom: 20px"
        >Chi tiết</a>
      </div>
    </div>
    <hr />
    <div class="row" style="margin-bottom: 30px">
      <div class="col-md-10">
        <h3 style=" font-weight:bold">TẤT CẢ CÂU HỎI</h3>
      </div>
      <div class="col-md-2">
        <a href="nhapcauhoi">
          <button type="button" style="font-size: 18px; font-weight:bold" class="btn btn-outline-danger">ĐẶT CÂU HỎI</button>
        </a>
      </div>
    </div>
    <div v-for="cauhoi in cauhois">
      <div class="row">
        <div class="col-md-1">
          <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
        </div>
        <div class="col-md-11" style="font-size: 16px">
          <a :href="'binhluan/'+ cauhoi.id">
            <h4 style="">{{cauhoi.tieu_de}}</h4>
          </a>
          <p>
            Tạo bởi: {{cauhoi.user.name}}
            <span
              style="margin-left: 20px"
            >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
            <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
            <br>
            {{cauhoi.so_cau_tra_loi}} trả lời
          </p>
        </div>
      </div>
      <p style="margin-top: px; font-size: 18px">{{cauhoi.noi_dung.substr(0, 250)}}...</p>
      <hr />
    </div>
    <div>
      <button>Tải thêm</button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["cauhois", "chudes"],
  data() {
    return {
      cauhoi: []
    };
  },
  created() {
    console.log(this.chudes);
  },
  methods: {}
};
</script>