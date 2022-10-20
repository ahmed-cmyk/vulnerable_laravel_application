<template>
  <main v-if="blog" class="detailView">
    <section v-if="!editMode">
      <div class="flex justify-end">
        <button class="btn btn-primary" @click="toggleEdit">edit</button>
        <button class="btn btn-danger" @click="callDelete">delete</button>
      </div>
      <div class="card">
        <h1 class="bold font-heading">{{ blog.title }}</h1>
        <p>{{ blog.body }}</p>
      </div>
    </section>
    <section v-else>
      <EditBlogView :blog="blog" @toggle="toggleEdit" />
    </section>
    <section class="my-2">
      <div class="flex justify-end">
        <button
          class="btn"
          :class="commentMode ? 'btn-danger' : 'btn-primary'"
          @click="toggleComment">
          {{ commentButton }}
        </button>
      </div>
      <h1 class="bold font-heading">Comments</h1>
      <CreateView />
      <div class="card">
        <h2 class="bold font-subheading">Author</h2>
        <p>{{ blog.body }}</p>
      </div>
    </section>
  </main>
</template>

<script>
import CreateView from "@/views/comments/CreateView.vue";
import EditBlogView from "./EditBlogView.vue";
export default {
  data() {
    return {
      id: this.$route.params.id,
      editMode: false,
      commentMode: false,
      commentButton: "Add Comment",
    };
  },
  computed: {
    blog() {
      return this.$store.getters.getBlogById(this.id)[0];
    },
    token() {
      return this.$store.state.user.token;
    },
    user() {
      return this.$store.state.user.user;
    },
  },
  created() {
    this.$store.dispatch("checkLocalStorage");
    this.$store.dispatch("getBlogs", this.token);
  },
  methods: {
    toggleEdit() {
      this.editMode = !this.editMode;
    },
    toggleComment() {
      this.commentMode = !this.commentMode;
      this.commentButton = this.commentMode ? "Cancel" : "Add Comment";
    },
    async callDelete() {
      const status = await this.$store.dispatch("deleteBlog", {
        id: this.id,
        token: this.token,
      });
      console.log(status);
      if (status === 200) {
        this.$store.dispatch("setMessage", "Blog deleted successfully");
        this.$router.push({ name: "home" });
      }
    },
  },
  components: { CreateView, EditBlogView },
};
</script>
