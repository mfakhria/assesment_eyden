export const smoothEase = [0.22, 1, 0.36, 1];

export const fadeUp = {
    hidden: { opacity: 0, y: 26 },
    show: {
        opacity: 1,
        y: 0,
        transition: { duration: 0.65, ease: smoothEase },
    },
};

export const staggerChildren = (delay = 0.13) => ({
    show: { transition: { staggerChildren: delay } },
});
