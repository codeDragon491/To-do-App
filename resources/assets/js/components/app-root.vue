<template>
    <div>
        <h1 class="text-center mt-4 text-4xl font-light text-grey-darkest">To-do App</h1>
        <!--<h2>total stuff outstanding: {{ totalTaskCount }}</h2>-->
        <p class="text-center mt-4 font-normal text-grey-darkest">This a Single-page To-do Application with Vue.js + Tailwind.CSS + Laravel</p>
         <table class="table-center w-3/4 mt-8">
             <tr class="bg-orange text-white">
                <th class="border-solid border text-left pt-3 pb-3 pl-2 font-semibold">Name</th>
                <th class="border-solid border text-left pt-3 pb-3 pl-2 font-semibold">Responsible</th>
                <th class="border-solid border text-left pt-3 pb-3 pl-2 font-semibold">Due Date</th>
                <th class="border-solid border text-left pt-3 pb-3 pl-2 font-semibold">Status</th>
                <th class="border-solid border text-left pt-3 pb-3 pl-2 font-semibold">Actions</th>
            </tr>
             <task-row v-for="(task,index) in tasks" :task="task" :user="user" :key="index"></task-row>
        </table>
        <add-task :tasks="tasks" :user="user" @save="addNewTask"></add-task>
    </div>
</template>

<script>
import TaskRow from "./task-row.vue";
import AddTask from "./add-task.vue";

export default {
  name: "app-root",
  components: { TaskRow, AddTask },
  computed: {
    totalTaskCount() {
      if (this.tasks == null) return 0;
      if (this.tasks.length == 0) return 0;

      let count = 0;
      for (var x = 0; x < this.tasks.length; x++) {
        if (this.tasks[x].status == "ongoing") count++;
      }

      return count;
    }
  },
  data() {
    return {
      createable: false, 
      tasks: [],
      user: [],
    };
  },
  mounted() {
    // Make a request for a user with a given ID
    let self = this;
    axios
      .get("/tasks")
      .then(function(response) {
        // handle success
        self.tasks = response.data.tasks;
        let user_id = response.data.user.id
        //self.tasks.find( x => x.responsible_id  == user_id).responsible_id = response.data.user.name;
        self.user = response.data.user;
        console.log(self.tasks);  
      })
      .catch(function(error) {
        // handle error
        console.log(error);
      })
      .then(function() {
        // always executed
      });
  },
  methods: {
    addNewTask(data) {
      // work with data: hint "push"
      this.tasks.push(data);
    },
    open() {
      this.createable = true;
    },
    save() {
      this.createable = false;
    },
    cancel() {
      this.createable = false;
    }
  }
};
</script>
