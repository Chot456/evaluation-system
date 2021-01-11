import Vue from "vue"
import VueRouter from "vue-router"

Vue.use(VueRouter)

import Dashboard from "../components/dashboard/container"
import Contact from "../components/contact/container"
import EvaluatorMain from "../components/Evaluator/EvaluatorMain"
import EvaluateProf from "../components/Evaluator/EvaluateProf"

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
    }

];

export default new VueRouter({
    routes   //short for `routes: routes:`
});