export const pageContent = window.pageContent ?? {};

export function getContent(key, fallback = '') {
    return pageContent[key] ?? fallback;
}
