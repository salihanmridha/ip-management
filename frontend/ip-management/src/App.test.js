import { render, screen } from '@testing-library/react';
import XApp from './XApp';

test('renders learn react link', () => {
  render(<XApp />);
  const linkElement = screen.getByText(/learn react/i);
  expect(linkElement).toBeInTheDocument();
});
