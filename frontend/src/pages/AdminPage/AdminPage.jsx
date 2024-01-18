import React from "react";
import { Outlet } from "react-router-dom";
import AdminTemplate from "@/templates/AdminTemplate/AdminTemplate";

const AdminPage = () => {
  return (
    <AdminTemplate>
      <div className="bg-white shadow rounded p-6">
        <Outlet />
      </div>
    </AdminTemplate>
  );
};

export default AdminPage;
