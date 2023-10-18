import {createBrowserRouter, Navigate} from "react-router-dom";
import DefaultLayout from "./components/DefaultLayout";
import GuestLayout from "./components/GuestLayout";
import Login from "./views/Login";
import NotFound from "./views/NotFound";
import IpAddressForm from "./views/IpAddressForm";
import IpAddresses from "./views/IpAddresses";
import AuditLogs from "./views/AuditLogs";

const router = createBrowserRouter([
  {
    path: '/',
    element: <DefaultLayout/>,
    children: [
      {
        path: '/',
        element: <Navigate to="/ip-address"/>
      },
      {
        path: '/ip-address',
        element: <IpAddresses />
      },
      {
        path: '/ip-address/create',
        element: <IpAddressForm key="ipAddressCreate" />
      },
      {
        path: '/ip-address/:id',
        element: <IpAddressForm key="ipAddressUpdate" />
      },
      {
        path: '/audit-log',
        element: <AuditLogs />
      }
    ]
  },
  {
    path: '/',
    element: <GuestLayout/>,
    children: [
      {
        path: '/login',
        element: <Login/>
      },
    ]
  },
  {
    path: "*",
    element: <NotFound/>
  }
])

export default router;
