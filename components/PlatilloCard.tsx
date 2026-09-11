import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

interface Props {
  nombre: string;
  descripcion: string;
  precio: number;
}

export const PlatilloCard = ({ nombre, descripcion, precio }: Props) => {
  return (
    <View style={styles.card}>
      <Text style={styles.titulo}>{nombre}</Text>
      <Text>{descripcion}</Text>
      <Text style={styles.precio}>${precio}</Text>
    </View>
  );
};

const styles = StyleSheet.create({
  card: { padding: 15, backgroundColor: '#f9f9f9', marginBottom: 10, borderRadius: 8 },
  titulo: { fontWeight: 'bold', fontSize: 16 },
  precio: { color: 'green', marginTop: 5 },
});