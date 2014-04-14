({
    mainConfigFile : "appclient/main.js",
    baseUrl: "appclient",
    removeCombined: true,
    findNestedDependencies: true,
	dir: "public/dist",
	optimizeCss: "standard",
	modules: [
		{
            name: "main"
		}
    ]
})