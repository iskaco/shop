export default function sendRequest(
    inertia,
    method,
    url,
    data = {},
    options = {}
) {
    const inertiaMethods = {
        get: () => inertia.get(url, data, options),
        post: () => inertia.post(url, data, options),
        put: () => inertia.put(url, data, options),
        patch: () => inertia.patch(url, data, options),
        delete: () => inertia.delete(route("admin." + url, data), options),
    };

    if (inertiaMethods[method.toLowerCase()]) {
        return inertiaMethods[method.toLowerCase()]();
    } else {
        throw new Error(`متد ${method} پشتیبانی نمی‌شود.`);
    }
}
