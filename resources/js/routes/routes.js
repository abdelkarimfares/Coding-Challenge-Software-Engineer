
import Products from "@/pages/product/Prodcuts.vue";
import CreateProduct from "@/pages/product/CreateProduct.vue";
import root from "@/pages/root.vue";

const routes = [
    {
      path: "/products",
      component: root,
      children: [
        {
          path: "",
          component: Products,
          name: "Products",
        },
        {
          path: "create",
          component: CreateProduct,
          name: "CreateProduct",
        },
        {
          path: "edit/:id",
          component: CreateProduct,
          name: "editProduct",
        
        },
      ]
    },
    
];

export default routes;
