import { Link, Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../context/ContextProvider";
import axiosClient from "../axios-client.js";
import { useEffect } from "react";

export default function DefaultLayout() {
  const { user, token, setUser, setToken, notification } = useStateContext();

  useEffect(() => {
    // Fetch data or perform other side effects here
    // axiosClient.get("/ip-address").then(({ data }) => {
    //   setUser(data);
    // });
  }, [token, setUser]);

  if (!token) {
    console.log(token)
    // If there's no token, navigate to the "/login" route
    return <Navigate to="/login" />;
  }

  const onLogout = (ev) => {
    ev.preventDefault();

    axiosClient.post("/logout").then(() => {
      setUser({});
      setToken(null);
    });
  };

  return (
      <div id="defaultLayout">
        <aside>
          <Link to="/ip-address">IP Address</Link>
          <Link to="/audit-log">Audit Log</Link>
        </aside>
        <div className="content">
          <header>
            <div>Header</div>

            <div>
              {user.name} &nbsp; &nbsp;
              <a onClick={onLogout} className="btn-logout" href="#">
                Logout
              </a>
            </div>
          </header>
          <main>
            <Outlet />
          </main>
          {notification && <div className="notification">{notification}</div>}
        </div>
      </div>
  );
}
