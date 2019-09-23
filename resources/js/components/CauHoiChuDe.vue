<template>
  <div class="container" style="font-family: 'Open Sans'">
    <div>
      <div class="row">
        <div class="col-md-2">
          <img :src="chude.anh_dai_dien" style="width: 180px; height:180px" />
        </div>
        <div class="col-md-10">
          <h4 style="font-weight:bold; font-size: 24px">Chủ đề: {{chude.tieu_de}}</h4>
          <p style="font-size: 16px">Tạo bởi: {{chude.user.name}}</p>
          <h5>{{chude.so_cau_hoi}} Câu hỏi</h5>
          <p style="font-size: 18px">{{chude.mo_ta}}</p>
        </div>
      </div>
    </div>
    <hr />
    <div class="row" style="margin-bottom: 10px; margin-top: 15px">
      <div class="col-md-10">
        <h4 style="font-weight:bold">DANH SÁCH CÁC CÂU HỎI</h4>
      </div>
      <div class="col-md-2">
        <a href="../nhapcauhoi">
          <button
            type="button"
            style="font-size: 18px; font-weight:bold"
            class="btn btn-outline-danger"
          >ĐẶT CÂU HỎI</button>
        </a>
      </div>
    </div>
    <br />
    <div v-for="cauhoi in cauhois">
      <div class="row">
        <div class="col-md-1">
          <img :src="cauhoi.user.anh_dai_dien" style="width: 80px; height:80px" />
        </div>
        <div class="col-md-11" style="font-size: 16px">
          <a :href="`../binhluan/${cauhoi.id}`">
            <h4>Tiêu đề: {{cauhoi.tieu_de}}</h4>
          </a>
          <p>
            Tạo bởi: {{cauhoi.user.name}}
            <span
              style="margin-left: 20px"
            >Chủ đề: {{cauhoi.chu_de.tieu_de}}</span>
            <span style="margin-left: 20px">Thời gian: {{cauhoi.created_at}}</span>
          </p>
        </div>
      </div>
      <p style="margin-top: 5px; font-size: 18px">{{cauhoi.noi_dung.substr(0, 250)}}...</p>
      <hr />
    </div>
  </div>
</template>
<script>
export default {
  props: ["cauhois", "chude"],
  data() {
    return {};
  },
  created() {
  }
};
</script>