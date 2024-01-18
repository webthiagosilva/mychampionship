import React from 'react';
import AuthTemplate from '@/templates/AuthTemplate/AuthTemplate';
import TextLink from '@/components/atoms/TextLink/TextLink';

const HomePage = () => {
  return (
    <AuthTemplate>
      <div className="flex flex-col items-center justify-center h-screen -mt-16"> {/* Ajuste o -mt-16 conforme necessário */}
        <div className="text-center">
          <h2 className="text-4xl font-bold text-blue-950 mb-6">Gerencie seus Campeonatos</h2>
          <p className="text-lg mb-6 text-blue-950">Participe e acompanhe seus campeonatos locais de forma simples e eficaz.</p>
          <TextLink to="/login" className="inline-block bg-blue-700 hover:bg-blue-700 text-white hover:text-gray-800 font-bold py-4 px-12 rounded">
            Acesse Agora
          </TextLink>
        </div>
      </div>
    </AuthTemplate>
  );
};

export default HomePage;
