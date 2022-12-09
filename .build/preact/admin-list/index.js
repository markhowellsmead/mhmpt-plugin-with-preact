import React from "react";
import ReactDOM from "react-dom";

import "./index.scss";

const App = () => {
	return <h1 dangerouslySetInnerHTML={{ __html: "Hello world" }} />;
};

const appElement = document.querySelector("[data-mhmpt-plugin-with-preact]");

if (appElement) {
	ReactDOM.render(<App />, appElement);
}
