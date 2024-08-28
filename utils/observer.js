export const observer = (callback, option) => {
  const ob = new IntersectionObserver(callback, option);
};
