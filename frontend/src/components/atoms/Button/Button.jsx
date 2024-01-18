import React from "react";

const Button = ({ text, type, disabled }) => {
  return (
    <button
      type={type}
      className={`w-full flex justify-center items-center px-4 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ${disabled ? 'opacity-50 cursor-not-allowed' : ''}`}
      disabled={disabled}
    >
      {text}
    </button>
  );
};

export default Button;
