import Vue from "vue"
import VueRouter from "vue-router"

Vue.use(VueRouter)

import Dashboard from "../components/dashboard/container"
import Contact from "../components/contact/container"
import EvaluatorMain from "../components/Evaluator/EvaluatorMain"
import EvaluateProf from "../components/Evaluator/EvaluateProf"
import Subject from "../components/Adminstrator/InformationManagement/Subject"
import Course from "../components/Adminstrator/InformationManagement/Course"
import Categories from "../components/Adminstrator/QuestionManagement/Categories"
import Questions from "../components/Adminstrator/QuestionManagement/Questions"
import Department from "../components/Adminstrator/AccountManagement/Department"
import Faculties from "../components/Adminstrator/AccountManagement/Faculties"
import Students from "../components/Adminstrator/AccountManagement/Students"
import Maintenance from "../components/Adminstrator/AccountManagement/Maintenance"
import Evaluation from "../components/Adminstrator/Report/Evaluation"
import ActivityLogs from "../components/Adminstrator/Report/ActivityLogs"
import ViewComputations from "../components/Adminstrator/Report/ViewComputations"
import ViewComments from "../components/Adminstrator/Report/ViewComments"
import ViewReport from "../components/Adminstrator/Report/ViewReprt"
import MultiFiltersPlugin  from "../../plugins/MultiFilters"

Vue.use(MultiFiltersPlugin); // <-- THIS




const routes = [
    {
        component: Dashboard,
        name: "dashboard",
        path: "/dashboard"
    },
    {
        component: Contact,
        name: "contact",
        path: "/contact"
    },{
        component: EvaluatorMain,
        name: "EvaluatorMain",
        path: "/EvaluatorMain"
    },{
        component: EvaluateProf,
        name: "EvaluateProf",
        path: "/EvaluateProf"
    },{
        component: Subject,
        name: "Subject",
        path: "/Subject"
    },{
        component: Course,
        name: "Course",
        path: "/Course"
    },{
        component: Categories,
        name: "Categories",
        path: "/Categories"
    },{
        component: Questions,
        name: "Questions",
        path: "/Questions"
    },{
        component: Department,
        name: "Department",
        path: "/Department"
    },{
        component: Faculties,
        name: "Faculties",
        path: "/Faculties"
    },{
        component: Students,
        name: "Students",
        path: "/Students"
    },{
        component: Maintenance,
        name: "Maintenance",
        path: "/Maintenance"
    }
    ,{
        component: Categories,
        name: "Categories",
        path: "/Categories"
    }
    ,{
        component: Questions,
        name: "Questions",
        path: "/Questions"
    }
    ,{
        component: ActivityLogs,
        name: "ActivityLogs",
        path: "/ActivityLogs"
    },{
        component: Evaluation,
        name: "Evaluation",
        path: "/Evaluation"
    },{
        component: ActivityLogs,
        name: "ActivityLogs",
        path: "/ActivityLogs"
    },{
        component: ViewComputations,
        name: "ViewComputations",
        path: "/ViewComputations"
    },{
        component: ViewComments,
        name: "ViewComments",
        path: "/ViewComments"
    },{
        component: ViewReport,
        name: "ViewReport",
        path: "/ViewReport"
    }


];

export default new VueRouter({
    routes   //short for `routes: routes:`
});