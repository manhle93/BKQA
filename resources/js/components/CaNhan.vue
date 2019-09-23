<template>
  <div class="container" style="font-family: 'Open Sans'">
    <div>
      <div class="row">
        <div class="col-md-3">
          <img :src="user.anh_dai_dien" style="width: 180px; height:180px" />
        </div>
        <div class="col-md-9">
          <h4 style="font-weight:bold; font-size: 24px">{{user.name}}</h4>
          <p style="font-size: 20px">Email: {{user.email}}</p>
          <p style="font-size: 20px">Ngày tham gia: {{user.created_at}}</p>
          <p style="font-size: 20px">Vai trò:</p>
        </div>
      </div>
    </div>
    <hr />
    <div>
       <div class="tabs">
        <a v-on:click="activetab=1" v-bind:class="[ activetab === 1 ? 'active' : '' ]">Bài viết</a>
        <a v-on:click="activetab=2" v-bind:class="[ activetab === 2 ? 'active' : '' ]">Câu hỏi chờ phê duyệt</a>
        <a v-on:click="activetab=3" v-bind:class="[ activetab === 3 ? 'active' : '' ]">Báo cáo vi phạm</a>
    </div>

    <div class="content">
        <div v-if="activetab === 1" class="tabcontent">
            Danh sách bài viết
        </div>
        <div v-if="activetab === 2" class="tabcontent">
            Câu hỏi, bài viết chờ phê duyệt
        </div>
        <div v-if="activetab === 3" class="tabcontent">
            Báo cáo vi phạm
        </div>
    </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user"],
  data() {
    return {
      noi_dung: "",
      activetab: 1 
    };
  },
  methods: {}
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

.tabs a{
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
    box-shadow: 3px 3px 6px #e1e1e1
}

</style>